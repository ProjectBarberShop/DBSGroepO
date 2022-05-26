<?php

namespace Database\Seeders;

use App\Models\LearnToSing;
use App\Models\LearnToSingCat;
use Database\Factories\LearnToSingFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearnToSingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LearnToSing::factory(20)->create();
    }
}
