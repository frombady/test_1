<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\Response\AnswerDto;
use App\Dto\Response\QuestionDto;
use App\Dto\Response\QuestionListDto;
use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\TestSession;
use App\Entity\UserAnswer;
use App\Repository\TestSessionRepository;
use App\Repository\TestSessionRepositoryInterface;
use App\Repository\UserAnswerRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly final class QuestionsService implements QuestionsServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserAnswerRepositoryInterface $userAnswerRepository,
    ) {
    }

    public function getQuestions(TestSession $session): QuestionListDto
    {
        $questionListDto = [];
        $questions = $this->em->getRepository(Question::class)->findAll();
        /** @var Question $question */
        foreach ($questions as $question) {
            $isQuestionRight = false;
            $answers = $this->em->getRepository(Answer::class)->findAllShuffled($question->getId());
            $answerList = [];
            /** @var Answer $answer */
            foreach ($answers as $answer) {
                $isRight = null;
                $userAnswer = $this->userAnswerRepository->findAnswerById($session, $question, $answer);
                if ($userAnswer) {
                    if ($answer->isCorrect()) {
                        $isRight = true;
                        $isQuestionRight = true;
                    } else {
                        $isRight = false;
                    }
                }

                $answerList[] = new AnswerDto(
                    id: $answer->getId(),
                    text: $answer->getText(),
                    isRight: $isRight,
                );
            }
            $questionListDto[] = new QuestionDto(
                id: $question->getId(),
                text: $question->getText(),
                answers: $answerList,
                isRight: $isQuestionRight,
            );
        }

        return new QuestionListDto($questionListDto);
    }

    public function getQuestionsShuffled(): QuestionListDto
    {
        $questionListDto = [];
        $questions = $this->em->getRepository(Question::class)->findAll();
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
}
