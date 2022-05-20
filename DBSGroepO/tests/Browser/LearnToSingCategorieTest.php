<?php

namespace Tests\Browser;

use App\Models\LearnToSingCat;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LearnToSingCategorieTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateCategorie()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit('cms/learntosing/categorie')
            ->assertPathIs('/cms/learntosing/categorie')
            ->type('#addCategorie', 'piano')
            ->press('Submit')
            ->assertPathIs('/cms/learntosing/categorie')
            ->pause(2000);
        });
    }

    public function testCreateDuplicateField()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit('cms/learntosing/categorie')
            ->assertPathIs('/cms/learntosing/categorie')
            ->type('#addCategorie', 'piano')
            ->press('Submit')
            ->assertPathIs('/cms/learntosing/categorie')
            ->type('#addCategorie', 'piano')
            ->press('Submit')
            ->assertsee('The title has already been taken.')
            ->pause(2000);
        });
    }

    public function testEditCategorie() {
        $this->browse(function (Browser $browser) {
            $data = LearnToSingCat::get()->last();
            $browser->loginAs(User::find(1))
            ->visit('cms/learntosing/categorie')
            ->assertPathIs('/cms/learntosing/categorie')
            ->type("#title$data->id", 'drummen')
            ->press("#update$data->id")
            ->assertPathIs('/cms/learntosing/categorie')
            ->pause(2000);
        });
    }

    public function testDeleteCategorie() {
        $this->browse(function (Browser $browser) {
            $data = LearnToSingCat::get()->last();
            $browser->loginAs(User::find(1))
            ->visit('cms/learntosing/categorie')
            ->assertPathIs('/cms/learntosing/categorie')
            ->press("#delete$data->id")
            ->assertPathIs('/cms/learntosing/categorie')
            ->pause(2000);
        });
    }


}


