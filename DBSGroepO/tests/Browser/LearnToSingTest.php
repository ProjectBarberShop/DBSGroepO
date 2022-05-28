<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LearnToSingTest extends DuskTestCase
{
    
    public function testLogin() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/cms/learntosing')
                ->assertPathIs('/cms/learntosing');
        });
    }

    public function testCreateCourse()
    {
        $this->browse(function (Browser $browser) {
            $date = now()->addDay();
            $browser->visit('/cms/learntosing/create')
            ->type('title', 'Dusk curses')
            ->type('description', 'Dusk beschrijving')
            ->press('Selecteer foto')
            ->press('.modal-content a:nth-child(1)')
            ->keys('#date', $date->day)
                    ->keys('#date', $date->month)
                    ->keys('#date', $date->year)
                    ->keys('#date', ['{tab}'])
                    ->keys('#date', $date->hour)
                    ->keys('#date', $date->minute)
            ->type('location', 'Dusk locatie')
            ->type('price', 69.69) 
            ->type('mentor', 'Dusk begeleider')     
            ->screenshot('filled')  
            ->scrollTo('#create')
            ->pause(2000)
            ->press('Aanmaken')
            ->assertSee('Cursus succesvol aangemaakt');
        });
    }

    public function testEditCourse()
    {
        $this->browse(function (Browser $browser) {
            $date = now()->addDays(2);
            $browser->visit('/cms/learntosing')
            ->clickLink('Bijwerken')
            ->type('title', 'Dusk curses bijgewerkt')
            ->type('description', 'Dusk beschrijving bijgewerkt')
            ->press('Selecteer foto')
            ->press('.modal-content a:nth-child(1)')
            ->keys('#date', $date->day)
                    ->keys('#date', $date->month)
                    ->keys('#date', $date->year)
                    ->keys('#date', ['{tab}'])
                    ->keys('#date', $date->hour)
                    ->keys('#date', $date->minute)
            ->type('location', 'Dusk locatie bijgewerkt')
            ->type('price', 69.69) 
            ->type('mentor', 'Dusk begeleider bijgewerkt')     
            ->screenshot('filled')  
            ->scrollTo('#edit')
            ->pause(2000)
            ->press('Wijzigen')
            ->assertSee('Cursus succesvol Bijgewerkt');
        });
    }

    public function testDeleteCourse()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/cms/learntosing')
            ->pause(2000)
            ->press('#remove')
            ->pause(2000)
            ->acceptDialog()
            ->assertPathIs('/cms/learntosing');
        });
    }
}
