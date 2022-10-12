<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use App\Entity\Recipe;
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

        //Ingredients
        $ingredients = [];
        for ($i = 0; $i < 50; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice(mt_rand(0, 100));
                $ingredients[] = $ingredient;
            $manager->persist($ingredient);
        }

        for ($j = 0; $j < 50; $j++) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->sentence(min: 1, max: 5))
                ->setTime(mt_rand(0, 1) === 1 ? mt_rand(1, 1440) : null)
                ->setServe(mt_rand(0, 1) === 1 ? mt_rand(1, 50) : null)
                ->setDifficulty(mt_rand(0, 1) === 1 ? mt_rand(1, 5) : null)
                ->setDescription($this->faker->text(300))
                ->setPrice(mt_rand(0, 1) === 1 ? mt_rand(1, 1000) : null)
                ->setIsFavorite(mt_rand(0, 1) === 1 ? true : false);

            for ($k=0; $k < mt_rand(5, 15); $k++) { 
                $recipe->addIngredient($ingredient[mt_rand(0, count($ingredients) - 1)]);
            }

            $manager->persist($recipe);
        }



        $manager->flush();
    }
}
