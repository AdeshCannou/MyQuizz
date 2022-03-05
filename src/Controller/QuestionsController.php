<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Questions;
use App\Entity\Quiz;
use App\Form\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Question\Question;

class QuestionsController extends AbstractController
{
    /**
     * @Route("/questions", name="questions")
     */
    public function index(): Response
    {
        return $this->render('questions/index.html.twig', [
            'controller_name' => 'QuestionsController',
        ]);
    }

    /**
     * @Route("/creation_questions/{quizz_id}", name="creation_questions")
     */
    public function creation_questions(Request $request, $quizz_id)
    {
        $question = new Questions();


        $formQuestions = $this->createForm(QuestionType::class, $question);

        $formQuestions->handleRequest($request);



        if ($formQuestions->isSubmitted() && $formQuestions->isValid()) {
            $question->setCreatedAt(new DateTimeImmutable());

            $repo = $this->getDoctrine()->getRepository(Quiz::class);
            $quizs = $repo->findOneBy(['id' => $quizz_id]);
            $question->setQuiz($quizs);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);

            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('questions/questions.html.twig', [
            'formQuestion' => $formQuestions->createView()
        ]);
    }
}
