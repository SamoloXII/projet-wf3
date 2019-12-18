<?php

namespace App\Controller;

use App\Entity\Prescription;
use App\Form\PrescriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrescriptionController extends AbstractController
{
    /**
     * @Route("/prescription")
     */
    public function index(Request $request)
    {
        $prescription = new Prescription();

        $form = $this->createForm(PrescriptionType::class, $prescription);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if ($form->isValid()){

                $prescription->setUsers($this->getUser());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($prescription);
                $entityManager->flush();

                $this->addFlash('success','Votre ordonnace a bien été ajouté');

                return $this->redirectToRoute("app_prescription_index");
            }else{
                $this->addFlash('error', 'Veuillez renseigner une ordonnance');
            }

        }

        return $this->render('prescription/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
