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
        DB::table('webpage')->insert([
            'template_id' => 1,
            'main_text' => '<h1 style="text-align: center;">Wie zijn wij</h1>
                            <p style="text-align: center;"><span style="font-size: 14pt;">
                            De <strong>Duketown Barbershop Singers</strong> zijn een stel enthousiaste mannen die in goede harmonie en met 
                            veel plezier onder de vakbekwame 
                            en bezielende leiding van <strong>Stef Fennis</strong> zich toeleggen op het beoefenen 
                            van barbershopzang en -entertainment. Het repertoire bestaat onder 
                            andere uit jazz, musical en ballads 
                            in barbershopstijl. Met ongeveer 
                            vijfentwintig leden afkomstig uit de 
                            wijde regio van ‘s-Hertogenbosch in 
                            leeftijd variërend van eind veertig 
                            tot reeds enige tijd gepensioneerd. 
                            We repeteren elke dinsdag (met uitzondering van vakanties) 2,5 uur. 
                            Daarna is het leuk nog even na te 
                            blijven om met een glaasje en enige 
                            zangnootjes nog wat samen te zingen. We noemen dat afterglow. Het 
                            koor streeft naar tien optredens per 
                            jaar. Dankzij een internationaal standaardrepertoire kunnen onze zangers bijna overal ter wereld zingen 
                            met ruim zeventigduizend andere 
                            barbershopzangers.
                             </span></p><p>&nbsp;</p>',
            'slug' => 'Wie-zijn-wij',
            'created_at' => now(),
        ]);
    }
}
