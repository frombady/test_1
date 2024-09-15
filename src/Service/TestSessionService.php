<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TestSession;
use App\Entity\UserAnswer;
use App\Repository\AnswerRepository;
use App\Repository\QuestionRepository;
use App\Repository\UserAnswerRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly final class TestSessionService implements TestSessionServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private QuestionRepository $questionRepository,
        private AnswerRepository $answerRepository,
        private UserAnswerRepository $userAnswerRepository,
    ) {
    }

    public function create(): TestSession
    {
        $testSession = new TestSession();
        $this->em->persist($testSession);

        return $testSession;
    }

    public function isCorrectAnswer(array $correctAnswerIds, array $userAnswerIds): bool
    {
        return true;
    }

    public function save(array $answers): TestSession
    {
        $session = new TestSession();
        $this->em->persist($session);
        foreach ($answers as $questionId => $answer) {
            $question = $this->questionRepository->find($questionId);
            foreach ($answer as $answerId) {
                $answer = $this->answerRepository->find($answerId);
                $userAnswer = new UserAnswer(
                    testSession: $session,
                    question: $question,
                    answer: $answer,
                );
                $this->em->persist($userAnswer);
            }
        }

        $this->em->flush();

        return $session;
    }
}
