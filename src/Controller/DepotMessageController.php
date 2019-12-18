<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\DepotMessageType;
use App\Repository\MedicamentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DepotMessageController extends AbstractController
{
    /**
     * @Route("/message/{id}")
     */
    public function index(Request $request, EntityManagerInterface $manager, MedicamentsRepository $repository, $id)
    {
        $medicament = $repository->find($id);

        $message = new Comment();
        $form = $this->createForm(DepotMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()){

                $message->setUsers($this->getUser());

                $manager->persist($message);
                $manager->flush();

                $this->addFlash('success', 'Vous avez posté un message');

                return $this->redirectToRoute('app_depotmessage_index', ['id' => $id]);
            }
            else{
                $this->addFlash('error','Veuillez renseignez un message');
            }
        }

        return $this->render('depot_message/index.html.twig', [
            'formDepotMessage' => $form->createView(),
            'medicament' => $medicament
        ]);
    }
}
