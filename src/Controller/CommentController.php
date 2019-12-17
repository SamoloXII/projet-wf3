<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{id}")
     */
    public function index(ThreadRepository $threadRepository, $id, CommentRepository $commentRepository)
    {
        $thread = $threadRepository->find($id);
        $comment = $commentRepository->findCommentByThread($thread);
        return $this->render('comment/index.html.twig', [
            'thread' => $thread,
            'comment' => $comment
        ]);
    }
}
