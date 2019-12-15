<?php

namespace App\Controller;

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

//    /**
//     * @param Request $request
//     * @return Response
//     * @Route("/search")
//     */
//    public function searchMedoc(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        // POST
//        $requestString = $request->get('m');
//
//        $posts = $em->getRepository('App:Medicaments')->findEntitiesByString($requestString);
//
//        if (!$posts) {
//
//            $result['posts']['error'] = "Post no found :(";
//        } else {
//            $result['posts']=$this->getRealEntities($posts);
//        }
//
//        return new Response(json_encode($result));
//
//    }
//
//    public function getRealEntities($posts)
//    {
//        foreach ($posts as $post){
//            $realEntities[$post->getId()] = [$post->getNom()];
//        }
//
//        return $realEntities;
//    }


}




