<?php


namespace App\Controller\Admin;

use App\Entity\Medicaments;
use App\Form\AjoutMedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $medicaments = new Medicaments();

        $form = $this->createForm(AjoutMedType::class, $medicaments);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                /** @var UploadedFile $image */
                $image = $medicaments->getImage();

                // seulemennt si une image est uploadée
                if (!is_null($image)) {
                    $filename = uniqid() . '.' . $image->guessExtension();

                    //déplace l'image uploadée vers le répertoire public/img/med
                    $image->move($this->getParameter('upload_dir'), $filename);

                    $medicaments->setImage($filename);

                }


                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($medicaments);
                $entityManager->flush();

                $this->addFlash('success', 'Le médicament a bien été ajouté');

                return $this->redirectToRoute('app_admin_affichagemed_index');
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