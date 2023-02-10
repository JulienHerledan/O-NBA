<?php

namespace App\Controller\Back;

use App\Entity\Teams;
use App\Form\Teams1Type;
use App\Repository\TeamsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/teams")
 */
class TeamsController extends AbstractController
{
    /**
     * @Route("/", name="app_back_teams_index", methods={"GET"})
     */
    public function index(TeamsRepository $teamsRepository): Response
    {
        return $this->render('back/teams/index.html.twig', [
            'teams' => $teamsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_teams_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TeamsRepository $teamsRepository): Response
    {
        $team = new Teams();
        $form = $this->createForm(Teams1Type::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teamsRepository->add($team, true);

            return $this->redirectToRoute('app_back_teams_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/teams/new.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_teams_show", methods={"GET"})
     */
    public function show(Teams $team): Response
    {
        return $this->render('back/teams/show.html.twig', [
            'team' => $team,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_teams_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Teams $team, TeamsRepository $teamsRepository): Response
    {
        $form = $this->createForm(Teams1Type::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teamsRepository->add($team, true);

            return $this->redirectToRoute('app_back_teams_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/teams/edit.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_teams_delete", methods={"POST"})
     */
    public function delete(Request $request, Teams $team, TeamsRepository $teamsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->request->get('_token'))) {
            $teamsRepository->remove($team, true);
        }

        return $this->redirectToRoute('app_back_teams_index', [], Response::HTTP_SEE_OTHER);
    }
}
