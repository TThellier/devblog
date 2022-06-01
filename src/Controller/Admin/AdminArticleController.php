<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Articles;

use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{
    #[Route('/admin/article', name: 'app_admin_article')]
    public function index(): Response
    {
        return $this->render('admin_article/index.html.twig', [
            'controller_name' => 'AdminArticleController',
        ]);
    }

    #[Route('/admin/createArticle', name: 'admin_article_create')]
    public function createArticle(Request $request): Response
    {
        $article = new Articles;
        $form=$this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $article->setCategory($this->getCategory());

            $em =$this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin');

        } 
        return $this->render('admin_article/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
