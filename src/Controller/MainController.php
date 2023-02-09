<?php

namespace App\Controller;

use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/Acceuil", name="app_main_home")
     */
    public function home(ConferenceRepository $cr): Response
    {
        $conferences= $cr->findAll();

        return $this->render('main/index.html.twig', [
            'conferences' => $conferences,
        ]);
    }
}
