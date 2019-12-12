<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ThreadsController extends AbstractController
{
    /**
     * @Route("/threads", name="threads")
     */
    public function index()
    {
        return $this->render('threads/index.html.twig', [
            'controller_name' => 'ThreadsController',
        ]);
    }
}
