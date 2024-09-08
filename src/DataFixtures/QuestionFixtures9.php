<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class QuestionFixtures9 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $question = new Question(
            text: '9 + 9 = ?',
        );

        $manager->persist($question);

        $answer_1 = new Answer(
            text: '18',
            isCorrect: true,
        );
        $answer_1->setQuestion($question);
        $manager->persist($answer_1);

        $answer_2 = new Answer(
            text: '9',
            isCorrect: false,
        );
        $answer_2->setQuestion($question);
        $manager->persist($answer_2);

        $answer_3 = new Answer(
            text: '17 + 1',
            isCorrect: true,
        );

        $answer_3->setQuestion($question);
        $manager->persist($answer_3);

        $answer_4 = new Answer(
            text: '16 + 2',
            isCorrect: true,
        );
        $answer_4->setQuestion($question);
        $manager->persist($answer_4);

        $manager->flush();
    }
}
