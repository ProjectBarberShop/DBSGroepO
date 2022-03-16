<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact-requests')->insert([
            'title' => str::random(10),
            'firstname' => str::random(10),
            'preprosition' => str::random(10),
            'lastname' => str::random(10),
            'email' =>  Str::random(10).'@gmail.com',
            'phonenumber' => int::random(10), 
            'message' => str::random(256),
        ]);
    }
}
