<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('nl');
        $path = __DIR__ . "/../../resources/views/contact/contact.blade.php";
        $file = file_get_contents($path);

        \DB::table('contact-requests')->insert([
            'title' => str::random(10),
            'firstname' => str::random(10),
            'preprosition' => str::random(10),
            'lastname' => str::random(10),
            'email' =>  Str::random(10).'@gmail.com',
            'phonenumber' => rand(1,10), 
            'message' => str::random(256),
        ]);

        \DB::table('webpages')->insert([
            'body' => $file
        ]);
    }
}
