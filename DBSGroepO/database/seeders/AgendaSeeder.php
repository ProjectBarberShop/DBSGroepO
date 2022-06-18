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
        Agendapunt::factory(15)->create();
        
        $categories = Category::all();

        Agendapunt::all()->each(function ($agendapunt) use ($categories) { 
            $value = $categories->find(mt_rand(0, $categories->count()));
            if($value !== null){
                $agendapunt->Category()->attach($value);
                $temp = $categories->find($value);
                $agendapunt->color = $temp->color;
                $agendapunt->save();
            }
        });
    }
}
