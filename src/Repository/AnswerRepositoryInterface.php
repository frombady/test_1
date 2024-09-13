<?php

declare(strict_types=1);

namespace App\Repository;

use Symfony\Component\Uid\Uuid;

interface AnswerRepositoryInterface
{
    public function findCorrectAnswerIdsByQuestion(Uuid $questionId): array;

    public function findAllShuffled(Uuid $questionId): array;
}
