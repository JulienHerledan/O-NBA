<?php

namespace App\Controller\Front;

use App\Entity\Teams;
use App\Form\TeamsType;
use App\Repository\TeamsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TeamsController extends AbstractController
{
    /**
     * @Route("/equipes", name="front_teams_index", methods={"GET"})
     */
    public function index(TeamsRepository $teamsRepository): Response
    {
        return $this->render('teams/index.html.twig', [
            'teams' => $teamsRepository->findAll(),
        ]);
    }


    /**
     * @Route("/equipes/{id}", name="front_teams_show", methods={"GET"})
     */
    public function show(Teams $team): Response
    {
        return $this->render('teams/show.html.twig', [
            'team' => $team,
        ]);
    }

}