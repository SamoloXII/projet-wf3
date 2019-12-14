<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function profil(){
        return $this->render('user/profil.html.twig');
    }

    /**
     * @Route("/calendrier")
     */
    public function calendrier(){
        return $this->render('user/calendrier.html.twig');
    }
}




