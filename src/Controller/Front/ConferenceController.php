<?php

namespace App\Controller\Front;

use App\Entity\Conference;
use App\Form\ConferenceType;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ConferenceController extends AbstractController
{
    /**
     * @Route("/conferences", name="front_conference_index", methods={"GET"})
     */
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return $this->render('Front/conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]);
    }

   
    /**
     * @Route("/conferences/{id}", name="app_conference_show", methods={"GET"})
     */
    public function show(Conference $conference): Response
    {
        return $this->render('Front/conference/show.html.twig', [
            'conference' => $conference,
        ]);
    }

}
