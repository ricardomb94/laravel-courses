<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CocktailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Cocktail::class;
    public function definition()
    {
        return [
            'titre' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'nombre_etape' => $this->faker->numberBetween(1, 10),
            'ingredients' => $this->faker->sentence(5),
        ];
    
    }
}
