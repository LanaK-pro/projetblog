<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Subject;

class AppFixtures extends Fixture
{

    private const NB_ARTICLES = 40;

    private const SUBJECTS = ["Mode", "Cuisine", "Humour", "News", "Histoire"];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $subjects = [];

        foreach (self::SUBJECTS as $subjectName) {
            $subject = new subject();
            $subject->setName($subjectName);

            $manager->persist($subject);
            $subjects[] = $subject;
        }

        for ($i = 0; $i < self::NB_ARTICLES; $i++) {
            $article = new Article();
            $article->setName($faker->sentence(3))
                ->setContent($faker->realTextBetween(250, 500))
                ->setDate($faker->dateTimeBetween('-2 years'))
                ->setSubject($faker->randomElement($subjects));

            $manager->persist($article);
        }
        $manager->flush();
    }
}

