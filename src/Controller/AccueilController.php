<?php

namespace App\Controller;

use App\Entity\Medicaments;
use App\Repository\MedicamentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
//     * @Route("/ajax/nom")
//     */
//    public function ajaxNom(MedicamentsRepository $repository)
//    {
////        $medicaments = $repository->findAll();
////
////        dump($medicaments);
////
////        return $this->render('accueil/index.html.twig',
////            [
////                'medicaments' => $medicaments
////            ]
////        );
//
////        return new Response($medicaments->getNom());
//    }

//    /**
//     * @Route("/search")
//     */
//    public function search(Request $request, MedicamentsRepository $medicamentsRepository)
//    {
//        $medoc = [];
//
//
//        if ($request->query->has('search-medoc')) {
//            $value = $request->query->get('search-medoc');
//
////        if($value != ''){
//            $medoc = $medicamentsRepository->search($value);
//        }
//
//
////            dump($medoc); die();
////        }
////        else{
////            $medoc = '';
////        }
//
//
//
//        return $this->render('accueil/index.html.twig',
//            [
//                'medicaments' => $medoc
//            ]
//        );
//    }

    /**
     * @Route("/search-result")
     */
    public function searchResult(Request $request, MedicamentsRepository $medicamentsRepository)
    {
        $medoc = [];
        $response = [];

        if ($request->query->has('term')) {
            $value = $request->query->get('term');

            $medoc = $medicamentsRepository->search($value);

            foreach ($medoc as $med) {
                $response[] = $med->getNom();
            }
        }

        return new JsonResponse($response);
    }

}




