<?php


namespace App\Controller\Admin;

use App\Entity\Medicaments;
use App\Form\AjoutMedType;
use App\Repository\MedicamentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AffichageMed
 * @package App\Controller\Admin
 *
 * @Route("/affichage_med")
 */
class AffichageMed extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(MedicamentsRepository $repository)
    {

        //Récupération des med en bdd -> 50 affichés max
        $medicaments = $repository->findBy([], ['id' => 'ASC'], 50);
//        echo '<pre>'; var_dump($medicaments); echo '</pre>';


        return $this->render(
            'admin/affichage_med.html.twig',
            [
                'medicaments' => $medicaments
            ]);
    }

    /**
     *
     * @Route("/edit/{id}", defaults={"id": null}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, EntityManagerInterface $manager, $id)
    {
        $originalImage = null;

        // creation si l'id est null
        if (is_null($id)) {

            return $this->redirectToRoute('app_admin_affichagemed_index');
            // modif s'il ne l'est pas
        } else {
            $medicaments = $manager->find(Medicaments::class, $id);

            if (is_null($medicaments)) {
                throw new NotFoundHttpException();
            }

            //si le medicament a une image associée
            if (!is_null($medicaments->getImage())) {
                $originalImage = $medicaments->getImage();

                $medicaments->setImage(
                    new File($this->getParameter('upload_dir') . $originalImage));
            }
        }

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

                    //en modif, on supprime l'ancienne image s'il y en a une
                    if (!is_null($originalImage)) {
                        unlink($this->getParameter('upload_dir') . $originalImage);
                    }
                } else {
                    // en modif, sans upload, on sette l'image avec le nom de l'ancienne

                    $medicaments->setImage($originalImage);
                }

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($medicaments);
                $entityManager->flush();

                $this->addFlash('success', 'La modification a bien été enregistré');

                return $this->redirectToRoute('app_admin_affichagemed_index');
            } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
        }

        return $this->render(
            'admin/editMed.html.twig',
            [
                'form' => $form->createView(),
                'original_image' => $originalImage
            ]
        );
    }

    /**
     * @Route("/suppression/{id}", requirements={"id": "\d+"})
     */
    public function delete(EntityManagerInterface $manager, Medicaments $medicaments)
    {
        $manager->remove($medicaments);
        $manager->flush();
        $this->addFlash('success','Le médicament a bien été supprimé');

        return $this->redirectToRoute('app_admin_affichagemed_index');
    }
}