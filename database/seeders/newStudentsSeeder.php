<?php

namespace Database\Seeders;
namespace app;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Students;

class newStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0;$i < 1000; $i++){
            Students::create([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'class' => fake()->numberBetween(1,10),
                'score' => fake()->numberBetween(0,100),
                'age' => fake()->numberBetween(8,19),              
            ]);
        }
    }
}
