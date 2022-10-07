<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Breakdown;
use App\Models\Random;
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
        Random::factory(rand(5, 10))->create()->each(function ($random) {
            $breakdown = Breakdown::factory(rand(5, 10))->make();

            $random->breakdown()->saveMany($breakdown);
        });
    }
}
