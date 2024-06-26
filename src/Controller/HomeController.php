<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/humeurs', name: 'app_humeurs')]
    public function humeurs(): Response
    {
        return $this->render('humeurs/humeurs.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    #[Route('/politique', name: 'app_politique')]
    public function politique(): Response
    {
        return $this->render('politique/_politique.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
