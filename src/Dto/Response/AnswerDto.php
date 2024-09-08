<?php

declare(strict_types=1);

namespace App\Dto\Response;

use Symfony\Component\Uid\Uuid;

final class AnswerDto
{
    public function __construct(
        private Uuid $id,
        private string $text,
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
}
