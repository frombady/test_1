<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\TestSession;
use App\Entity\UserAnswer;

interface UserAnswerRepositoryInterface
{
    public function findAnswerById(TestSession $session, Question $question, Answer $answer): ?array;
}
