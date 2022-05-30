<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CoctailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Bourbon',
            'ingredients' => '2 cl de bourbon, 2 cl de jus de citron, 2 cl de sirop de sucre',
            'price' => '10 €'
        ];
    }
}
