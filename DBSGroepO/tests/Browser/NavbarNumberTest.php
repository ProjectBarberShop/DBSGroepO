<?php

namespace Tests\Browser;

use App\Models\NavbarItem;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NavbarNumberTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHigherNumberNavbar()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit('cms/navbar')
            ->assertPathIs('/cms/navbar')
            ->press('#higher1')
            ->assertPathIs('/cms/navbar')
            ->pause(2000);
        });
    }

    public function testLowerNumberNavbar()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit('cms/navbar')
            ->assertPathIs('/cms/navbar')
            ->press('#lower2')
            ->assertPathIs('/cms/navbar')
            ->pause(2000);
        });
    }

    public function testCheckIfLastNavbarItemRemovedArrow() {

        $this->browse(function (Browser $browser) {
            $navbarItem = NavbarItem::get()->last();
            $oneLower = $navbarItem->number - 1;
            $browser->loginAs(User::find(1))
            ->visit('cms/navbar')
            ->assertPathIs('/cms/navbar')
            ->press("#delete$navbarItem->id")
            ->acceptDialog()
            ->assertNotPresent("#higher$oneLower")
            ->pause(2000);
        });
    }

    public function testNumberHasGivenWhenAddNewNavigation() {
        $this->browse(function (Browser $browser) {
            $navbarItem = NavbarItem::get()->last();
            $oneHigher = $navbarItem->number + 1;
            $browser->loginAs(User::find(1))
            ->visit('cms/navbar')
            ->assertPathIs('/cms/navbar')
            ->type('name' , 'contact')
            ->type('link', 'contact')
            ->press("#addNavigation")
            ->assertPresent("#lower$oneHigher")
            ->pause(2000);
        });
    }
}
