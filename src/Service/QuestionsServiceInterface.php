<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Response\QuestionListDto;
use App\Entity\TestSession;

interface QuestionsServiceInterface
{
    public function getQuestionsShuffled(): QuestionListDto;

    public function getQuestions(TestSession $session): QuestionListDto;
}
