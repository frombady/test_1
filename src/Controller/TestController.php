<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\AnswerRepository;
use App\Repository\QuestionRepository;
use App\Service\TestSessionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
        private readonly TestSessionServiceInterface $testSessionService,
        private readonly QuestionRepository $questionRepository,
        private readonly AnswerRepository $answerRepository,
    ) {
    }

    #[Route('/', name: 'test_start', methods: Request::METHOD_GET)]
    public function startTest(): Response
    {
        $questions = $this->questionRepository->findAllShuffled();

        return $this->render('test/start.html.twig', [
            'questions' => $questions,
        ]);
    }

    public function submitTest(Request $request): Response
    {
        // Рендерим страницу с результатами теста
        return $this->render('test/result.html.twig', [
            'correctAnswers' => $correctAnswers,
            'incorrectAnswers' => $incorrectAnswers,
        ]);
    }
}
