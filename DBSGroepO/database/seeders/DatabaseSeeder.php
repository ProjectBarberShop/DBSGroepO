<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            CatagorySeeder::class,
            Footerseeder::class,
            NavbarSeeder::class,
            UserSeeder::class,
            WebpageSeeder::class,
            LearnToSingCategorySeeder::class,
            AgendaSeeder::class,
        ]);
    }
}
