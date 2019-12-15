<?php

namespace App\Controller;

use App\Entity\Medicaments;
use App\Repository\MedicamentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccueilController
 * @package App\Controller
 *
 * @Route("/")
 */
class AccueilController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {

        return $this->render('accueil/index.html.twig');
    }


    /**
     * @Route("/profil")
     */
    public function profil()
    {
        return $this->render('user/profil.html.twig');
    }

    /**
     * @Route("/calendrier")
     */
    public function calendrier()
    {
        return $this->render('user/calendrier.html.twig');
    }

    /**
     * @Route("/ajax/nom")
     */
    public function ajaxNom(MedicamentsRepository $repository)
    {
//        $medicaments = $repository->findAll();
//
//        dump($medicaments);
//
//        return $this->render('accueil/index.html.twig',
//            [
//                'medicaments' => $medicaments
//            ]
//        );

//        return new Response($medicaments->getNom());
    }


}




