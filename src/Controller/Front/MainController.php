<?php

namespace App\Controller\Front;

use App\Entity\Conference;
use App\Repository\ConferenceRepository;
use App\Service\ApiSports;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/Accueil", name="front_main_home")
     */
    public function home(ConferenceRepository $cr, ApiSports $api): Response
    {
        $conferences= $cr->findAll();

        return $this->render('Front/main/index.html.twig', [
            'conferences' => $conferences,
            // dd($conferences)
        ]);
    }

    /**
     * @Route("/conférences/{id}", name="front_main_show")
     */
    public function show(Conference $conference): Response
    {
        return $this->render('Front/main/conf.html.twig', [
            'conference' => $conference,
        ]);
    }

}
