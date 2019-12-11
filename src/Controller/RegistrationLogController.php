<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationLogType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationLogController extends AbstractController
{

    /**
     * @Route("/")
     */
//    public function index()
//    {
//
//    }

    /**
     * @Route("/registration")
     */
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $user = new Users();
        $form = $this->createForm(RegistrationLogType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $user->setPassword(
                    $passwordEncoder->encodePassword($user, $user->getPassword())
                );

                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success', 'Votre compte est créé');

                return $this->redirectToRoute('app_registrationlog_register');
            }
            else {
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
}
