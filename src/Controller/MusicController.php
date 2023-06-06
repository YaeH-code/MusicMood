<?php

namespace App\Controller;

use App\Entity\Music;
use App\Form\Music1Type;
use App\Repository\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/music')]
class MusicController extends AbstractController
{
    #[Route('/', name: 'app_music_index', methods: ['GET'])]
    public function index(MusicRepository $musicRepository): Response
    {
        return $this->render('music/index.html.twig', [
            'music' => $musicRepository->findAll(),
        ]);
    }

   

    #[Route('/{id}', name: 'app_music_show', methods: ['GET'])]
    public function show(Music $music): Response
    {

        $comments = $music->getComments();

        return $this->render('music/show.html.twig', [
            'music' => $music,
            'comments' => $comments 
        ]);
    }




}
