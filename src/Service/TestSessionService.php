<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TestSession;
use Doctrine\ORM\EntityManagerInterface;

readonly final class TestSessionService implements TestSessionServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
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
}
