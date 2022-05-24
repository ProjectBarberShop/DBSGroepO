<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $navbaritems = [
            ['id' => 1, 'name' => 'Home', 'link' => '/' , 'number' => 1],
            ['id' => 2, 'name' => 'Even voorstellen', 'link' => '#', 'number' => 2],
            ['id' => 3, 'name' => 'Optredens', 'link' => '#', 'number' => 3],
            ['id' => 4, 'name' => 'Introductiecursus', 'link' => '#', 'number' => 4],
            ['id' => 5, 'name' => 'Agenda', 'link' => '#', 'number' => 5],
            ['id' => 6, 'name' => 'Informatie', 'link' => '#', 'number' => 6],
            ['id' => 7, 'name' => 'Nieuws', 'link' => 'nieuws', 'number' => 7],
            ['id' => 8, 'name' => 'Contact', 'link' => 'contact', 'number' => 8],
        ];

        $dropdownitems = [
            ['id' => 1, 'navbar_item_id' => 2, 'name' => 'Dirigent', 'link' => 'onze-dirigent'],
            ['id' => 2, 'navbar_item_id' => 2, 'name' => 'Wie zijn wij', 'link' => 'Wie-zijn-wij'],
            ['id' => 3, 'navbar_item_id' => 2, 'name' => 'Repetoire', 'link' => '#'],
            ['id' => 4, 'navbar_item_id' => 2, 'name' => 'Koorleden', 'link' => '#'],
            ['id' => 5, 'navbar_item_id' => 3, 'name' => 'Alle optredens', 'link' => 'optredens'],
            ['id' => 6, 'navbar_item_id' => 3, 'name' => 'Album', 'link' => '#'],
            ['id' => 7, 'navbar_item_id' => 3, 'name' => 'Muzieklijst', 'link' => '#'],
        ];
        DB::table('navbaritems')->insert($navbaritems);
        DB::table('dropdownitems')->insert($dropdownitems);
    }
}
