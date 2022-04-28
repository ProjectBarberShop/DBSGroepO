<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ImagesSystemTest extends DuskTestCase
{
    public function testFotoToevoegen()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('#login');
            $browser->assertPathIs('/login');
            $browser->type('email', 'admin@gmail.com');
            $browser->type('password', 'Admin123');
            $browser->press('Login');
            $browser->assertPathIs('/cms/home');
            $browser->clickLink('More info');
            $browser->visit('/cms/fotos');
            $browser->attach('absolutePathToFile', 'photo');
            $browser->type('title', 'Duif');
            $browser->type('category', 'Dier');
            $browser->press('+');
            $browser->assertPathIs('/cms/fotos');
        });

    }

    public function testFotoZoekenMetFilter()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('#login');
            $browser->assertPathIs('/login');
            $browser->type('email', 'admin@gmail.com');
            $browser->type('password', 'Admin123');
            $browser->press('Login');
            $browser->assertPathIs('/cms/home');
            $browser->visit('/cms/fotos');
            $browser->select('Dier', 'filter');
            $browser->press('Zoeken');
            $browser->assertPathIs('/cms/fotos');
            $browser->assertSee('Duif');
            $browser->assertDontSee('Koor');
        });

    }
    public function testFotoZoekenZonderFilter()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('#login');
            $browser->assertPathIs('/login');
            $browser->type('email', 'admin@gmail.com');
            $browser->type('password', 'Admin123');
            $browser->press('Login');
            $browser->assertPathIs('/cms/home');
            $browser->visit('/cms/fotos');
            $browser->type('search', 'Duif');
            $browser->press('Zoeken');
            $browser->assertPathIs('/cms/fotos');
	        $browser->assertSee('Duif');
        });

    }
    public function testFotoVerwijderen()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('#login');
            $browser->assertPathIs('/login');
            $browser->type('email', 'admin@gmail.com');
            $browser->type('password', 'Admin123');
            $browser->press('Login');
            $browser->assertPathIs('/cms/home');
            $browser->visit('/cms/fotos');
            $browser->press('');
            $browser->assertPathIs('/cms/fotos');
	        $browser->assertDontSee('Duif');
        });

    }
}
