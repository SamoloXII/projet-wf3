<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\DepotMessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DepotMessageController extends AbstractController
{
    /**
     * @Route("/message")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $message = new Comment();
        $form = $this->createForm(DepotMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()){

                $manager->persist($message);
                $manager->flush();

                $this->addFlash('success', 'Vous avez posté un message');

                return $this->redirectToRoute('app_depotmessage_index');
            }
            else{
                $this->addFlash('error','Veuillez renseignez un message');
            }
        }

        return $this->render('user/message.html.twig', [
            'formDepotMessage' => $form->createView(),
        ]);
    }
}
