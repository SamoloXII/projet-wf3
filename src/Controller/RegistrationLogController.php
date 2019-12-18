<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationLogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationLogController extends AbstractController
{

    /**
     * @Route("/registration")
     */
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $user = new Users();
        $form = $this->createForm(RegistrationLogType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $user->setPassword(
                    $passwordEncoder->encodePassword($user, $user->getPassword())
                );

                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success', 'Votre compte est créé');

                return $this->redirectToRoute('app_registrationlog_register');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render('registration_log/register.html.twig',
            [
                'registrationLogForm' => $form->createView()
            ]
        );
    }


    /**
     * @Route("/connexion")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function connexion(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


        if (!empty($error)) {
            $this->addFlash('error', 'Identifiants incorrects');
        } else {
//            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('registration_log/connexion.html.twig',
            [
                'last_username' => $lastUsername
            ]
        );
    }

    /**
     * @Route("/deconnexion")
     */
    public function logout()
    {

    }

    /**
     * @Route("/oubli-mot-de-passe", name="app_forgotten_password", methods="GET|POST")
     */
    public function forgottenPassword(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(Users::class)->findOneBy(['email' => $email]);

            if ($user === null) {
                $this->addFlash('danger', 'Email inconnu, réessayer à nouveau!');
                return $this->redirectToRoute('app_forgotten_password');
            }

            // Génére un token lié au mail
            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);


                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_accueil_index');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);


            $message = (new \Swift_Message('Oubli de mot de passe - Réinitialisation'))
                ->setFrom(array('ollivier.johan92@gmail.com' => 'Tokepi'))
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('registration_log/emails/resetPasswordMail.html.twig',
                        [
                            'user' => $user,
                            'url' => $url
                        ]
                    ),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('notice', 'Mail envoyé');

            return $this->redirectToRoute('app_registrationlog_connexion');
        }

        return $this->render('registration_log/forgottenPassword.html.twig');

    }

    /**
     * @Route("/reinitialiser-mot-de-passe/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        //Reset avec le mail envoyé
        if($request->isMethod('POST')){

            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(Users::class)->findOneByResetToken($token);


            if($user === null){
                $this->addFlash('danger', 'Mot de passe non reconnu');
                return $this->redirectToRoute('app_accueil_index');
            }

            $user->setResetToken(null);

            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

            $entityManager->flush();

            $this->addFlash('notice', 'Mot de passe mis à jour !');

            return $this->redirectToRoute('app_registrationlog_connexion');
        }
        else {
            return $this->render('registration_log/resetPassword.html.twig', ['token' => $token]);
        }

    }
}
