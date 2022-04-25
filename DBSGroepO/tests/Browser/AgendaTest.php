<?php

namespace Tests\Browser;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AgendaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::find(1);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/cms/agenda')
                    ->click('#createbutton')
                    ->type('title', 'Peter')
                    ->type('description', 'Peter zijn verjaardag')
                    ->select('category')
                    ->type('start', date('Y-m-d\TH:i', strtotime("2022-04-23 11:25:06")))
                    ->type('start', date('Y-m-d\TH:i', strtotime("2022-04-24 11:25:06")))
                    ->assertUrlIs('/cms/agenda');
        });
    }
}
