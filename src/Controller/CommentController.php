<?php

namespace App\Controller;

use App\Entity\Music;
use App\Entity\Comment;
use App\Form\Comment1Type;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTimeImmutable;

#[Route('/music/{id}/comment')]
class CommentController extends AbstractController
{
    #[Route('/new', name: 'app_comment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Music $music, CommentRepository $commentRepository): Response
    {
        $user = $this->getUser();
        
        // Vérifier si l'utilisateur est connecté et a les rôles requis
        if (!$user || !($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_ADMIN'))) {
            return $this->redirectToRoute('app_login');
        }

        $comment = new Comment();
        $comment->setCreatedAt(new DateTimeImmutable());
        $comment->setUser($user);
        $comment->setMusic($music);
        
        $form = $this->createForm(Comment1Type::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentRepository->save($comment, true);

            return $this->redirectToRoute('app_music_show', [
                'id' => $music->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }
}
