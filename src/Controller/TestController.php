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

    #[Route('/test', name: 'test_answer', methods: [Request::METHOD_GET, Request::METHOD_POST])]
    public function submitTest(Request $request): Response
    {
        if ($request->getMethod() === Request::METHOD_POST) {

        }

        /** @var Question $questions */
        $questions = $this->questionsService->getQuestions();
        return $this->render('test/test.html.twig', [
            'questions' => $questions,
        ]);
    }
}
