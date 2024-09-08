<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserAnswerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserAnswerRepository::class)]
final class UserAnswer
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UuidType::NAME, unique: true)]
        #[ORM\GeneratedValue(strategy: 'CUSTOM')]
        #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
        private readonly ?Uuid $id = null,
        #[ORM\ManyToOne(inversedBy: 'userAnswers')]
        #[ORM\JoinColumn(nullable: false)]
        private ?TestSession $testSession = null,
        #[ORM\ManyToOne(inversedBy: 'userAnswers')]
        #[ORM\JoinColumn(nullable: false)]
        private ?Question $question = null,
        #[ORM\ManyToOne]
        #[ORM\JoinColumn(nullable: false)]
        private ?Answer $answer = null,
    ) {
    }
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTestSession(): ?TestSession
    {
        return $this->testSession;
    }

    public function setTestSession(?TestSession $testSession): self
    {
        $this->testSession = $testSession;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?Answer
    {
        return $this->answer;
    }

    public function setAnswer(?Answer $answer): self
    {
        $this->answer = $answer;

        return $this;
    }
}
