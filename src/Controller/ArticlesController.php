<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'articles')]
    public function index(EntityManagerInterface $entityManager): Response
    {
            $articles = $entityManager
            ->getRepository(Articles::class)
            ->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
