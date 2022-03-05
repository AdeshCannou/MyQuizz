<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use DateTimeImmutable;
use App\Entity\Questions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function index(): Response
    {
        return $this->render('quiz/index.html.twig', [
            'controller_name' => 'QuizController',
        ]);
    }

    /**
     * @Route("/quiz/new", name="quiz_creation")
     */
    public function creation(Request $request)
    {
        $quiz = new Quiz();
        $user = $this->getUser();
        $question = new Questions();
        $formQuiz = $this->createForm(QuizType::class, $quiz);

        $formQuiz->handleRequest($request);


        if ($formQuiz->isSubmitted() && $formQuiz->isValid()) {

            $quiz->setCreatedAt(new DateTimeImmutable());
            $quiz->setCreatedBy($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quiz);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('quiz/creation.html.twig', [
            'formQuiz' => $formQuiz->createView(),
        ]);
    }

    /**
     * @Route("/quizz/{id}", name="edit_quiz")
     */
    public function edit(Quiz $quiz, Request $request)
    {
        $user = $this->getUser();
        $formQuiz = $this->createForm(QuizType::class, $quiz);

        $formQuiz->handleRequest($request);

        if ($formQuiz->isSubmitted() && $formQuiz->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }



        return $this->render('quiz/edit.html.twig', [
            'question' => $quiz->getQuestions(),
            'formQuiz' => $formQuiz->createView()
        ]);
    }

    /**
     * @Route("/quizz/play/{id}", name="quiz_play")
     */
    public function play(Quiz $quiz)
    {

        return $this->render('quiz/play.html.twig', [
            'quiz' => $quiz
        ]);
    }

    /**
     * @Route("/quizz/{id}/delete", name="quiz_delete")
     * @param Quiz $quiz
     * @return ReirectRoute
     */
    public function deleteQuiz(Quiz $quiz): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quiz);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
