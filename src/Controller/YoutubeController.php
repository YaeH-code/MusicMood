<?php

namespace App\Controller;

use App\Service\YoutubeApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YoutubeController extends AbstractController
{
    /**
     * @Route("/youtube/search/{query}", name="youtube_search")
     */
    public function search(YoutubeApiService $youTubeService, string $query): Response
    {
        $videos = $youTubeService->searchVideos($query);

        // Faites quelque chose avec les vidéos récupérées, par exemple, les afficher dans un template Twig.

        return $this->render('youtube/search.html.twig', [
            'videos' => $videos,
        ]);
    }
}
