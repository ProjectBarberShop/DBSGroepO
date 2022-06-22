<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CatagorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'title' => 'optredens',
            'color' => '#DFF900'
        ]);
        DB::table('category')->insert([
            'title' => 'verjaardag',
            'color' => '#F900F1'
        ]);
        DB::table('category')->insert([
            'title' => 'uitje',
            'color' => '#00F9F9'
        ]);
    }
}
