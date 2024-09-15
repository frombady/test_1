<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Symfony\Component\Uid\Uuid;

final class QuestionDto
{
    public function __construct(
        private Uuid $id,
        private string $text,
        private array $answers,
        private ?bool $isRight = null,
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }

    public function isRight(): ?bool
    {
        return $this->isRight;
    }

    public function setIsRight(?bool $isRight): void
    {
        $this->isRight = $isRight;
    }
}
