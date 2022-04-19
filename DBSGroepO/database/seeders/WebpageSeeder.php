<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebpageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('webpage')->insert([
            'template_id' => 1,
            'main_text' => '<h1 style="text-align: center;">Onze Dirigent</h1>
                            <p style="text-align: center;"><span style="font-size: 14pt;">
                            De huidige dirigent is Stef Fennis, hij is sinds augustus 2019 de musical Director (MD) van de Duketown Barbershop Singers.
                             </span></p><p>&nbsp;</p>',
            'slug' => 'onze-dirigent',
            'created_at' => now(),
        ]);
    }
}
