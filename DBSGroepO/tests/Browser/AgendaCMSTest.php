<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AgendaCMS;
use Tests\DuskTestCase;

class AgendaCMSTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAgendaWorks()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->assertSee('Dashboard barbershop');
        });
    }
    public function testDropDownWorks() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->select('@catdropdown', 1)
                    ->clickAndWaitForReload('@catsubmit')
                    ->assertDontSeeIn(Category::find(1)->title, 'card');
        });
    }
}
