<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlatFactory extends Factory
{

    /**
     *
     */
    protected $model = Plat::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph,
            'coctail_id' => Cocktail::factory(),
            'created_at' => now(),
        ];

        /**
         * Aulieu d'utiliser le seeding, on va utiliser tinker en cli
         *
         * ___tinker est un bac à sable Php pour écrire du Php
         *
         * ___Ensuite on lance l'instruction php Plat::factory()->count(5)->create()
         * Cela créera 5 plats dans la BDD
         */
    }
}
