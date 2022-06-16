<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use App\Models\Webpages;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class removeImageFromWebpageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDetachImageFromWebpage()
    {
        $this->browse(function (Browser $browser) {
            $webpage = Webpages::find(1);
            $webpage->Image()->attach(1);
            $browser->loginAs(User::find(1))
                    ->visit('/cms/paginas')
                    ->click('#allImages1')
                    ->click('#ImageRemove1')
                    ->assertPathIs('/cms/paginas')
                    ->pause(2000);
        });
    }
}
