<?php

namespace App\Controller;

use App\Entity\Mood;
use App\Form\Mood1Type;
use App\Repository\MoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mood')]
class MoodController extends AbstractController
{
    #[Route('/', name: 'app_mood_index', methods: ['GET'])]
    public function index(MoodRepository $moodRepository): Response
    {
        return $this->render('mood/index.html.twig', [
            'moods' => $moodRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_mood_show', methods: ['GET'])]
    public function show(Mood $mood): Response
    {
        
        $music = $mood->getMusic();
        return $this->render('mood/show.html.twig', [
            'mood' => $mood,
            'music' => $music
        ]);
    }
}
