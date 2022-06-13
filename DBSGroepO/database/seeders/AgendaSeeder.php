<?php

namespace Database\Seeders;

use App\Models\Agendapunt;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agendapunt::factory(30)->create();
        
        $categories = Category::all();
        Agendapunt::all()->each(function ($agendapunt) use ($categories) { 
            $agendapunt->Category()->attach($categories->get(mt_rand(0, $categories->count())));
        });
    }
}
