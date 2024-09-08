<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TestSession;
use Doctrine\ORM\EntityManagerInterface;

interface TestSessionServiceInterface
{
    public function create(): TestSession;
}
