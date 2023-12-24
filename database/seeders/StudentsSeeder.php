<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Students;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      //  $faker = Faker\Factory::create();
        for($i = 0;$i < 100; $i++){
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
