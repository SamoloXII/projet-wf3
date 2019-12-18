<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\DepotMessageType;
use App\Repository\CommentRepository;
use App\Repository\ThreadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{id}")
     */
    public function index(ThreadRepository $threadRepository, $id, CommentRepository $commentRepository, Request $request, EntityManagerInterface $manager)
    {
        $thread = $threadRepository->find($id);
        $comment = $commentRepository->findCommentByThread($thread);

        $message = new Comment();
        $form = $this->createForm(DepotMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()){

                $message->setUsers($this->getUser());
                $message->setThread($thread);


                $manager->persist($message);
                $manager->flush();

                $this->addFlash('success', 'Vous avez posté un message');

                return $this->redirectToRoute('app_comment_index', ['id' => $id]);
            }
            else{
                $this->addFlash('error','Veuillez renseignez un message');
            }
        }













        return $this->render('comment/index.html.twig', [
            'thread' => $thread,
            'comment' => $comment,
            'formDepotMessage' => $form->createView()
        ]);
    }
}
