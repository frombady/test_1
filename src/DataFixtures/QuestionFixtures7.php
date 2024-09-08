<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class QuestionFixtures7 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $question = new Question(
            text: '7 + 7 = ?',
        );

        $manager->persist($question);

        $answer_1 = new Answer(
            text: '5',
            isCorrect: false,
        );
        $answer_1->setQuestion($question);
        $manager->persist($answer_1);

        $answer_2 = new Answer(
            text: '14',
            isCorrect: true,
        );
        $answer_2->setQuestion($question);
        $manager->persist($answer_2);

        $manager->flush();
    }
}
