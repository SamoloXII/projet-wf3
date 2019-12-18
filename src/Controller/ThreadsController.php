<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Form\DepotThreadType;
use App\Repository\MedicamentsRepository;
use App\Repository\ThreadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ThreadsController extends AbstractController
{
    /**
     * @Route("/threads/{id}")
     */
    public function index(MedicamentsRepository $medrepository, $id, ThreadRepository $threadrepository, Request $request, EntityManagerInterface $manager)
    {
        $medicament = $medrepository->find($id);
        $thread = $threadrepository->findThreadByMedicament($medicament);

        $sujet = new Thread();
        $form = $this->createForm(DepotThreadType::class, $sujet);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()){

                $sujet->setUsers($this->getUser());
                $sujet->setMedicament($medicament);
                $sujet->setThread($thread);


                $manager->persist($sujet);
                $manager->flush();

                $this->addFlash('success', 'Vous avez crée un thread');

                return $this->redirectToRoute('app_threads_index', ['id' => $id]);
            }
            else{
                $this->addFlash('error','Veuillez renseignez un message');
            }
        }






        return $this->render('threads/index.html.twig', [
            'medicament' => $medicament,
            'thread' => $thread,
            'formDepotThread' => $form->createView()
        ]);
    }
}
