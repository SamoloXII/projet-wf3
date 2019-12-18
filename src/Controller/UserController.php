<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\ModifProfilType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/{id}")
     */
    public function index(UsersRepository $users, $id)
    {

        $user = $users->find($id);
        return $this->render('user/index.html.twig',
            [
            'user' => $user
            ]
        );
    }

    /**
     * @Route("/profil/{id}", requirements={"id":"\d+"})
     */
    public function profil($id,
                           EntityManagerInterface $manager,
                           Request $request){


        $originalImage = null;

        if (is_null($id)) {

            return $this->redirectToRoute('app_accueil_index');
        } else {
            $user = $manager->find(Users::class, $id);

            if (is_null($user)){
                throw New NotFoundHttpException();
            }

            if(!is_null($user->getImage())){
                $originalImage = $user->getImage();

                $user->setImage(
                    new File($this->getParameter('upload_dir') . $originalImage)
                );
            }
        }

        $form = $this->createForm(ModifProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                /** @var UploadedFile $image */
                $image = $user->getImage();

                // seulemennt si une image est uploadée
                if (!is_null($image)) {
                    $filename = uniqid() . '.' . $image->guessExtension();

                    //déplace l'image uploadée vers le répertoire public/img/profil
                    $image->move($this->getParameter('upload_dir'), $filename);

                    $user->setImage($filename);

                    //en modif, on supprime l'ancienne image s'il y en a une
                    if (!is_null($originalImage)) {
                        unlink($this->getParameter('upload_dir') . $originalImage);
                    }
                } else {
                    // en modif, sans upload, on sette l'image avec le nom de l'ancienne

                   $user->setImage($originalImage);
                }


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'La modification a bien été enregistré');

            }
        }


        return $this->render('user/profil.html.twig',
            [
                'user' => $user,
                'form' => $form->createView(),
                'original_image' => $originalImage

            ]);
    }

}
