<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Question;
use App\Repository\AnswerRepository;
use App\Repository\QuestionRepository;
use App\Service\QuestionsServiceInterface;
use App\Service\TestSessionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
        private readonly TestSessionServiceInterface $testSessionService,
        private readonly QuestionsServiceInterface $questionsService,
        private readonly QuestionRepository $questionRepository,
        private readonly AnswerRepository $answerRepository,
    ) {
    }

    #[Route('/', name: 'test_start', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function startTest(Request $request): Response
    {
        //dd($request->getMethod());
        //dd($request->getMethod() === Request::METHOD_POST);
        if ($request->getMethod() === Request::METHOD_POST) {
            return $this->redirectToRoute('test_answer');
        }

        return $this->render('test/start.html.twig');
    }

    #[Route('/test', name: 'test_answer', methods: [Request::METHOD_GET])]
    public function submitTest(): Response
    {
        $questions = $this->questionsService->getQuestionsShuffled();

        /** @var Question $questions */
        return $this->render('test/test.html.twig', [
            'questions' => $questions,
        ]);
    }

    #[Route('/test', name: 'test_result', methods: [Request::METHOD_POST])]
    public function resultTest(Request $request)
    {
        if ($request->getMethod() === Request::METHOD_POST) {
            $session = $this->testSessionService->save($request->get('answers'));

            $questions = $this->questionsService->getQuestions($session);
            //dd($questions);
            return $this->render('test/result.html.twig', [
                'questions' => $questions,
            ]);
        }
    }
}
