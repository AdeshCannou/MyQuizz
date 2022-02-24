<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyQuizController extends AbstractController
{
    /**
     * @Route("/my_quiz", name="my_quiz")
     */
    public function index(): Response
    {
        return $this->render('my_quiz/index.html.twig', [
            'controller_name' => 'MyQuizController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('my_quiz/home.html.twig');
    }

    
}
