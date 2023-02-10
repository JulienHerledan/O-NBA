<?php

namespace App\Controller\Back;

use App\Entity\Conference;
use App\Form\Conference1Type;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/conference")
 */
class ConferenceController extends AbstractController
{
    /**
     * @Route("/", name="app_back_conference_index", methods={"GET"})
     */
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return $this->render('back/conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_conference_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ConferenceRepository $conferenceRepository): Response
    {
        $conference = new Conference();
        $form = $this->createForm(Conference1Type::class, $conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conferenceRepository->add($conference, true);

            return $this->redirectToRoute('app_back_conference_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/conference/new.html.twig', [
            'conference' => $conference,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_conference_show", methods={"GET"})
     */
    public function show(Conference $conference): Response
    {
        return $this->render('back/conference/show.html.twig', [
            'conference' => $conference,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_conference_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Conference $conference, ConferenceRepository $conferenceRepository): Response
    {
        $form = $this->createForm(Conference1Type::class, $conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conferenceRepository->add($conference, true);

            return $this->redirectToRoute('app_back_conference_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/conference/edit.html.twig', [
            'conference' => $conference,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_conference_delete", methods={"POST"})
     */
    public function delete(Request $request, Conference $conference, ConferenceRepository $conferenceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conference->getId(), $request->request->get('_token'))) {
            $conferenceRepository->remove($conference, true);
        }

        return $this->redirectToRoute('app_back_conference_index', [], Response::HTTP_SEE_OTHER);
    }
}
