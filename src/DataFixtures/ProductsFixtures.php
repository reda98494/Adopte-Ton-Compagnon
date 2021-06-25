<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductsFixtures extends Fixture
{
  protected $faker;
  protected $productType = array("food", "toy");
  public function load(ObjectManager $manager)
  {
    $this->faker = Factory::create();
    for ($i = 0; $i < 30; $i++) {
      $product = new Product();
      $product->setName($this->faker->company);
      $product->setType($this->productType[array_rand($this->productType, 1)]);
      $product->setPrice($this->faker->numberBetween(5,90));
      $product->setDescription($this->faker->sentence);
      $manager->persist($product);
    }
    $manager->flush();
  }
}
