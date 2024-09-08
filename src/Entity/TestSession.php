<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TestSessionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TestSessionRepository::class)]
final class TestSession
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UuidType::NAME, unique: true)]
        #[ORM\GeneratedValue(strategy: 'CUSTOM')]
        #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
        private readonly ?Uuid $id,
        #[ORM\Column(type: 'datetime')]
        private ?DateTimeInterface $createdAt,
        #[ORM\OneToMany(targetEntity: UserAnswer::class, mappedBy: 'testSession', cascade: ['persist', 'remove'], orphanRemoval: true)]
        private Collection $userAnswers,
    ) {
        $this->userAnswers = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, UserAnswer>
     */
    public function getUserAnswers(): Collection
    {
        return $this->userAnswers;
    }

    public function addUserAnswer(UserAnswer $userAnswer): self
    {
        if (!$this->userAnswers->contains($userAnswer)) {
            $this->userAnswers->add($userAnswer);
            $userAnswer->setTestSession($this);
        }

        return $this;
    }

    public function removeUserAnswer(UserAnswer $userAnswer): self
    {
        if ($this->userAnswers->removeElement($userAnswer)) {
            // Установить сторону отношений на null (если это необходимо)
            if ($userAnswer->getTestSession() === $this) {
                $userAnswer->setTestSession(null);
            }
        }

        return $this;
    }
}
