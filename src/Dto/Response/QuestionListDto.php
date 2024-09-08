<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Symfony\Component\Uid\Uuid;

final class QuestionListDto
{
    public function __construct(
        private array $question,
    ) {
    }

    public function getQuestion(): array
    {
        return $this->question;
    }

    public function setQuestion(array $question): void
    {
        $this->question = $question;
    }
}
