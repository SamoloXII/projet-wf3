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
     * @Route("/")
     */
    public function index()
    {

        $user = $this->getUser();

        return $this->render('user/index.html.twig',
            [
            'user' => $user
            ]
        );
    }

    /**
     * @Route("/profil")
     */
    public function profil(
                           EntityManagerInterface $manager,
                           Request $request)
    {
        $originalImage = null;

        if (is_null($this->getUser())) {

            return $this->redirectToRoute('app_accueil_index');
        } else {
            $user = $manager->find(Users::class, $this->getUser());

            if (is_null($user)){
                throw New NotFoundHttpException();
            }

            if(!is_null($user->getImage())){
                $originalImage = $user->getImage();

                $user->setImage(
                    new File($this->getParameter('upload_profil') . $originalImage)
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
                    $image->move($this->getParameter('upload_profil'), $filename);

                    $user->setImage($filename);

                    //en modif, on supprime l'ancienne image s'il y en a une
                    if (!is_null($originalImage)) {
                        unlink($this->getParameter('upload_profil') . $originalImage);
                    }
                } else {
                    // en modif, sans upload, on sette l'image avec le nom de l'ancienne

                   $user->setImage($originalImage);
                }

                $manager->persist($user);
                $manager->flush();

                $this->addFlash('success', 'La modification a bien été enregistré');

            } else {
                $this->addFlash('error', 'La modification n\'a pas été enregistré');
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
