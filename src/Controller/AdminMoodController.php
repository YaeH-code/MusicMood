<?php

namespace App\Controller;

use App\Entity\Mood;
use App\Form\MoodType;
use App\Repository\MoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/mood')]
class AdminMoodController extends AbstractController
{
    #[Route('/', name: 'app_admin_mood_index', methods: ['GET'])]
    public function index(MoodRepository $moodRepository): Response
    {
        // Check if the user has the required role
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin_mood/index.html.twig', [
            'moods' => $moodRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_mood_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MoodRepository $moodRepository): Response
    {
        $mood = new Mood();
        $form = $this->createForm(MoodType::class, $mood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moodRepository->save($mood, true);

            return $this->redirectToRoute('app_admin_mood_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_mood/new.html.twig', [
            'mood' => $mood,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_mood_show', methods: ['GET'])]
    public function show(Mood $mood): Response
    {
        return $this->render('admin_mood/show.html.twig', [
            'mood' => $mood,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_mood_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mood $mood, MoodRepository $moodRepository): Response
    {
        $form = $this->createForm(MoodType::class, $mood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moodRepository->save($mood, true);

            return $this->redirectToRoute('app_admin_mood_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_mood/edit.html.twig', [
            'mood' => $mood,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_mood_delete', methods: ['POST'])]
    public function delete(Request $request, Mood $mood, MoodRepository $moodRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mood->getId(), $request->request->get('_token'))) {
            $moodRepository->remove($mood, true);
        }

        return $this->redirectToRoute('app_admin_mood_index', [], Response::HTTP_SEE_OTHER);
    }

        // Add the following method to handle the redirection
        #[Route('/redirect', name: 'app_admin_mood_redirect')]
        public function redirectAction(): Response
        {
            // Redirect the user to the login page for admin
            return $this->redirectToRoute('app_login');
        }
    }

