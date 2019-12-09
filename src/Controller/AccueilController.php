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
}
