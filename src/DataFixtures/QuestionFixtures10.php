<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class QuestionFixtures10 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $question = new Question(
            text: '10 + 10 = ?',
        );

        $manager->persist($question);

        $answer_1 = new Answer(
            text: '0',
            isCorrect: false,
        );
        $answer_1->setQuestion($question);
        $manager->persist($answer_1);

        $answer_2 = new Answer(
            text: '2',
            isCorrect: false,
        );
        $answer_2->setQuestion($question);
        $manager->persist($answer_2);

        $answer_3 = new Answer(
            text: '8',
            isCorrect: false,
        );

        $answer_3->setQuestion($question);
        $manager->persist($answer_3);

        $answer_4 = new Answer(
            text: '20',
            isCorrect: true,
        );
        $answer_4->setQuestion($question);
        $manager->persist($answer_4);

        $manager->flush();
    }
}
