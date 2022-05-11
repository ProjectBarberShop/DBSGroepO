<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use SebastianBergmann\Template\Template;
use Tests\DuskTestCase;
use App\Models\User;

class TemplateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit(new Template)
                ->assertPathIs('/cms/paginas');
        });
    }

    public function testTemplate()
    {
        $this->browse(function (Browser $browser) {
            $browser->press('@removeTemplate')
            ->pause(5000)
            ->press('Selecteer template');
        });
    }
}
