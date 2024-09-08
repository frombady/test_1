<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Response\QuestionListDto;

interface QuestionsServiceInterface
{
    public function getQuestions(): QuestionListDto;
}
