<?php


namespace App\Controller\Admin;

use App\Entity\Medicaments;
use App\Form\AjoutMedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AjoutMedicament
 * @package App\Controller\admin
 *
 * @Route("/")
 */
class AjoutMedicament extends AbstractController
{
    /**
     * @Route("/ajout_med")
     */
    public function index(Request $request)
    {
        $medicament = new Medicaments();

        $form = $this->createForm(AjoutMedType::class, $medicament);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            if($form->isValid()){

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($medicament);
                $entityManager->flush();

                $this->addFlash('success', 'Le médicament a bien été ajouté');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render(
            'admin/ajoutMed.html.twig',
            [
                'form' => $form->createView()
            ]);
    }
}