<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnimalFixtures extends Fixture
{
  protected $faker;
  protected $races = array("cat", "dog", "bird");
  public function load(ObjectManager $manager)
    {
      $this->faker = Factory::create();
      for ($i = 0; $i < 20; $i++) {
        $animal = new Animal();
        $animal->setName($this->faker->name);
        $animal->setRace($this->races[array_rand($this->races, 1)]);
        $animal->setWeight($this->faker->numberBetween(5,15));
        $animal->setAge($this->faker->numberBetween(0,15));
        $animal->setDescription($this->faker->text(150));
        $animal->setAdoptedStatus(false);
        $manager->persist($animal);
      }
        $manager->flush();
    }
}
