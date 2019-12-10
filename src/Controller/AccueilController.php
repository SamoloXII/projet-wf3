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
     * @Route("/accueil")
     */
    public function index()
    {

        return $this->render('accueil/index.html.twig');
    }

    /**
     * @Route("/message")
     */
    public function message(){
        return $this->render('user/message.html.twig');
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

    /**
     * @Route("/medicament")
     */
    public function medicament(){
        return $this->render('user/medicament.html.twig');
    }
}




