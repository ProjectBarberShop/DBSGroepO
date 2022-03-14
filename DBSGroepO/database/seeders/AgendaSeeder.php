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
        $categorylength = Category::all()->count();
        $categories = Category::find(mt_rand(0, $categorylength));
        $sampledata = [
            'title'=>str::random(10),
            'description'=>str::random(100),
            'start'=>Carbon::now()->subMinutes(rand(1, 55)),
            'end'=>Carbon::now()->minutes(rand(1, 55)),
        ];

        $agenda = Agendapunt::create($sampledata);
        $agenda->Categories()->attach($categories);

        $categories = Category::find(mt_rand(0, $categorylength));
        $sampledata = [
            'title'=>str::random(10),
            'description'=>str::random(100),
            'start'=>Carbon::now()->subMinutes(rand(1, 55)),
            'end'=>Carbon::now()->minutes(rand(1, 55)),
        ];

        $agenda = Agendapunt::create($sampledata);
        $agenda->Categories()->attach($categories);
    }
}
