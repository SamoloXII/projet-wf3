<?php

namespace App\Controller;

use App\Repository\MedicamentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MedicpageController extends AbstractController
{
    /**
     * @Route("/medicpage/{id}")
     */
    public function index(MedicamentsRepository $repository, $id)
    {

        //Récupération des med en bdd
        $medicament = $repository->find($id);
        $image = $medicament->getImage();
//        echo '<pre>'; var_dump($medicaments); echo '</pre>';

        return $this->render('medicpage/index.html.twig', [
            'medicament' => $medicament,
            'image' => $image
        ]);
    }
}
