<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GestionMessageController extends AbstractController
{
    /**
     * @Route("/gestion_message")
     */
    public function index(CommentRepository $repository)
    {
        //Récupération des comments en bdd
        $comments = $repository->findBy([], ['id' => 'ASC'], 50);


        return $this->render('admin/gestion_message.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/suppression/{id}")
     */
    public function delete(EntityManagerInterface $manager, Comment $comment)
    {
        $manager->remove($comment);
        $manager->flush();
        $this->addFlash('success', 'Le message a bien été supprimé');

        return $this->redirectToRoute("app_admin_gestionmessage_index");
    }

}


