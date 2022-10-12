<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Recette;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\HttpKernel\Fragment\FragmentUriGenerator;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice(mt_rand(0, 100));
            $manager->persist($ingredient);
        }

        for ($i = 0; $i < 50; $i++){
            $recette = new Recette();
            $recette->setName($this->faker->sentence(min:3, max:5))
            ->setTime(mt_rand(1, 24))
            ->setServe(mt_rand(1, 50))
            ->setHardness(mt_rand(1, 5))
            ->setDescription($this->faker->sentences)
            ->setPrice(mt_rand(0, 1000));
            $manager->persist($recette);
        }



        $manager->flush();
    }
}
