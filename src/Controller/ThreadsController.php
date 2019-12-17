<?php

namespace App\Controller;

use App\Repository\MedicamentsRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ThreadsController extends AbstractController
{
    /**
     * @Route("/threads/{id}")
     */
    public function index(MedicamentsRepository $medrepository, $id, ThreadRepository $threadrepository)
    {
        $medicament = $medrepository->find($id);
        $thread = $threadrepository->find($id);

        return $this->render('threads/index.html.twig', [
            'medicament' => $medicament,
            'thread' => $thread
        ]);
    }
}
