<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class QuestionFixtures8 extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $question = new Question(
            text: '8 + 8 = ?',
        );

        $manager->persist($question);

        $answer_1 = new Answer(
            text: '16',
            isCorrect: true,
        );
        $answer_1->setQuestion($question);
        $manager->persist($answer_1);

        $answer_2 = new Answer(
            text: '12',
            isCorrect: false,
        );
        $answer_2->setQuestion($question);
        $manager->persist($answer_2);

        $answer_3 = new Answer(
            text: '9',
            isCorrect: false,
        );

        $answer_3->setQuestion($question);
        $manager->persist($answer_3);

        $answer_4 = new Answer(
            text: '5',
            isCorrect: false,
        );
        $answer_4->setQuestion($question);
        $manager->persist($answer_4);

        $manager->flush();
    }
}
