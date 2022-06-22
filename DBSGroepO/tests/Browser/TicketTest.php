<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Tests\Browser\Pages\TicketCMS;
use Tests\Browser\Pages\TicketPage;

class TicketTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateTicket()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit(new TicketCMS)
            ->assertPathIs('/cms/tickets')
            ->scrollTo('.row:nth-child(2)')
            ->pause(2000)
            ->select('agenda', '26')
            ->type('amount', 100)
            ->type('price', '12,50')
            ->check('ispublished')
            ->press('@addTicket')
            ->pause(2000);
        });
    }

    public function testEditTicket() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit(new TicketCMS)
            ->assertPathIs('/cms/tickets')
            ->clickLink('Bijwerken')
            ->type('amount', 150)
            ->type('price', '15,-')
            ->check('ispublished')
            ->press('@editTicket')
            ->pause(2000);
        });
    }

    public function testSendTicket()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new TicketPage)
            ->assertPathIs('/boeking')
            ->type('name', "BarberShop")
            ->type('address', "Bordeslaan 191")
            ->type('postalcode', "5223 MK")
            ->type('place', "'s-Hertogenbosch")
            ->type('phonenumber', "+31 06 22 45 78 37")
            ->type('email', env('MAIL_USERNAME'))
            ->select('amount')
            ->press('@sendTicket')
            ->pause(2000);
        });
    }

    public function testRemoveTicket() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit(new TicketCMS)
            ->assertPathIs('/cms/tickets')
            ->press('Verwijderen')
            ->pause(2000)
            ->acceptDialog();
        });
    }
}
