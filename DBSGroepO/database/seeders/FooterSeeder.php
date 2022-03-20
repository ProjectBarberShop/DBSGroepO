<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footer')->insert([
            'address' => 'Bordeslaan 191, 5223 MK s-Hertogenbosch',
            'email' => 'info@duketownbarbershopsingers.nl',
            'phonenumber' => '+31 06 22 45 78 37',
            'secretaryemail' => 'secretaris@duketownbarbershopsingers.nl',
            'kvk' => 2738282,
            'facebookurl' => 'https://www.facebook.com/DuketownBarbershopSingers',
        ]);
    }
}
