<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class MyQuizController extends AbstractController
{
    /**
     * @Route("/my_quiz", name="my_quiz")
     */
    public function index(): Response
    {
        return $this->render('my_quiz/index.html.twig');
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $repo = $this->getDoctrine()->getRepository(Quiz::class);

        $quizs = $repo->findAll();

        return $this->render('my_quiz/index.html.twig',[
            'quizs' => $quizs
        ]);
    }

    

    
}
