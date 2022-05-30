<?php

namespace Database\Seeders;

use App\Models\Plat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Plat::factory()
            ->times(5)
            ->hasCocktail(1)
            ->create();     //
    }
}
