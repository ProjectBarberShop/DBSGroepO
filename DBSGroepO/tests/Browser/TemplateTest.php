<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Tests\Browser\Pages\Template;

class TemplateTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTemplate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit(new Template)
                ->assertPathIs('/cms/paginas')
                ->press('@removeTemplate')
                ->acceptDialog()
                ->press('Selecteer template')
                ->press('@selectedTemplate')
                ->press('Template bijwerken')
                ->visit('onze-dirigent')
                ->assertPathIs('/onze-dirigent')
                ->pause(5000);
        });
    }
}
