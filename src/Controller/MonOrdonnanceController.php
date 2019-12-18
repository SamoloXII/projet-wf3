<?php

namespace App\Controller;

use App\Entity\Prescription;
use App\Repository\PrescriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MonOrdonnanceController extends AbstractController
{
    /**
     * @Route("/ordonnance")
     */
    public function index(PrescriptionRepository $repository)
    {
        //récupération des ordonnances en bdd
        $prescription = $repository->findBy(['users' => $this->getUser()], ['id' => 'ASC'], 10);


        return $this->render('mon_ordonnance/index.html.twig', [
            'prescription' => $prescription,
        ]);
    }


    /**
     * @Route("/suppression/{id}", requirements={"id": "\d+"})
     */
    public function delete(EntityManagerInterface $manager, Prescription $prescription)
    {
        $manager->remove($prescription);
        $manager->flush();
        $this->addFlash('success', 'Votre ordonnance a bien été supprimée');

        return $this->redirectToRoute('app_monordonnance_index');
    }

}
