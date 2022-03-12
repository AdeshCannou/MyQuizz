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

        if ($user) {
            return $this->render('quiz/creation.html.twig', [
                'formQuiz' => $formQuiz->createView(),
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
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

        if ($this->getUser() <> NULL) {
            $emailAdmin = $this->getUser()->getEmail();
        } else {
            $emailAdmin = '';
        }
        if ($emailAdmin == 'root@root.fr' || $quiz->getCreatedBy() == $user) {
            return $this->render('quiz/edit.html.twig', [
                'question' => $quiz->getQuestions(),
                'formQuiz' => $formQuiz->createView()
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/quizz/play/{id}", name="quiz_play")
     */
    public function play(Quiz $quiz)
    {
        $user = $this->getUser();
        if ($user) {
            return $this->render('quiz/play.html.twig', [
                'quiz' => $quiz
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/quizz/{id}/delete", name="quiz_delete")
     * @param Quiz $quiz
     * @return ReirectRoute
     */
    public function deleteQuiz(Quiz $quiz): RedirectResponse
    {
        $user = $this->getUser();
        if ($this->getUser() <> NULL) {
            $emailAdmin = $this->getUser()->getEmail();
        } else {
            $emailAdmin = '';
        }

        if ($emailAdmin == 'root@root.fr' || $quiz->getCreatedBy() == $user) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($quiz);
            $em->flush();
        }
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("quiz/{id}/score", name="quiz_score")
     */
    public function afficheScore(Quiz $quiz): Response
    {
        $user = $this->getUser();
        if ($user) {
            return $this->render('quiz/score.html.twig', [
                'quiz' => $quiz
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
