<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Response\AnswerDto;
use App\Dto\Response\QuestionDto;
use App\Dto\Response\QuestionListDto;
use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;

readonly final class QuestionsService implements QuestionsServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function getQuestionsShuffled(): QuestionListDto
    {
        $questionListDto = [];
        $questions = $this->em->getRepository(Question::class)->findAllShuffled();
        /** @var Question $question */
        foreach ($questions as $question) {
            $answers = $this->em->getRepository(Answer::class)->findAllShuffled($question->getId());
            $answerList = [];
            /** @var Answer $answer */
            foreach ($answers as $answer) {
                $answerList[] = new AnswerDto(
                    id: $answer->getId(),
                    text: $answer->getText(),
                );
            }
            $questionListDto[] = new QuestionDto(
                id: $question->getId(),
                text: $question->getText(),
                answers: $answerList
            );
        }

        return new QuestionListDto($questionListDto);
    }

    public function getQuestions(): QuestionListDto
    {
        $questionListDto = [];
        $questions = $this->em->getRepository(Question::class)->findAll();
        /** @var Question $question */
        foreach ($questions as $question) {
            $answers = $this->em->getRepository(Answer::class)->findAllByQuestionById($question->getId());
            $answerList = [];
            /** @var Answer $answer */
            foreach ($answers as $answer) {
                $answerList[] = new AnswerDto(
                    id: $answer->getId(),
                    text: $answer->getText(),
                );
            }
            $questionListDto[] = new QuestionDto(
                id: $question->getId(),
                text: $question->getText(),
                answers: $answerList
            );
        }

        return new QuestionListDto($questionListDto);
    }
}
