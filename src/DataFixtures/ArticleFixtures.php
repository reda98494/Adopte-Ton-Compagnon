<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    protected $faker;
    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $article = new Article();
            $article->setTitle($this->faker->title);
            $article->setContent($this->faker->text(255));
            $article->setDate(new \DateTimeImmutable());

            $manager->persist($article);
        }
        $manager->flush();
    }
}
