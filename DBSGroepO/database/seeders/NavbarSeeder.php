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
            ['id' => 1, 'name' => 'Home', 'link' => '/'],
            ['id' => 2, 'name' => 'Even voorstellen', 'link' => '#'],
            ['id' => 3, 'name' => 'Optredens', 'link' => '#'],
            ['id' => 4, 'name' => 'Introductiecursus', 'link' => '#'],
            ['id' => 5, 'name' => 'Agenda', 'link' => '#'],
            ['id' => 6, 'name' => 'Informatie', 'link' => '#'],
            ['id' => 7, 'name' => 'Nieuws', 'link' => 'nieuws'],
            ['id' => 8, 'name' => 'Contact', 'link' => 'contact'],
        ];

        $dropdownitems = [
            ['id' => 1, 'navbar_item_id' => 2, 'name' => 'Dirigent', 'link' => 'onze-dirigent'],
            ['id' => 2, 'navbar_item_id' => 2, 'name' => 'Wie zijn wij', 'link' => '#'],
            ['id' => 3, 'navbar_item_id' => 2, 'name' => 'Repetoire', 'link' => '#'],
            ['id' => 4, 'navbar_item_id' => 2, 'name' => 'Koorleden', 'link' => '#'],
            ['id' => 5, 'navbar_item_id' => 3, 'name' => 'Alle optredens', 'link' => '#'],
            ['id' => 6, 'navbar_item_id' => 3, 'name' => 'Album', 'link' => '#'],
            ['id' => 7, 'navbar_item_id' => 3, 'name' => 'Muzieklijst', 'link' => '#'],
        ];
        DB::table('navbaritems')->insert($navbaritems);
        DB::table('dropdownitems')->insert($dropdownitems);
    }
}
