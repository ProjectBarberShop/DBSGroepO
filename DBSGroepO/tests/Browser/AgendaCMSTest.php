<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
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
    public function testAgendaShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->assertSee('Dashboard barbershop');
        });
    }
    public function testAgendaCreate() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->click('@createbutton')
                    ->type('title', 'titelvoorbeeld')
                    ->type('description', 'voorbeeld beschrijving')
                    ->type('start', '20')
                    ->type('start', '05')
                    ->type('start', '2022')
                    ->keys('#start', ['{tab}'])
                    ->type('start', '2000')
                    ->type('end', '21')
                    ->type('end', '05')
                    ->type('end', '2022')
                    ->keys('#end', ['{tab}'])
                    ->type('end', '2000')
                    ->select('category', 1)
                    ->click('@createsubmit')
                    ->assertUrlIs('http://127.0.0.1:8000/cms/agenda');
        });
    }
    public function testAgendaEdit() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->click('@agendaeditbutton')
                    ->type('title', 'titelvoorbeeld')
                    ->type('description', 'voorbeeld beschrijving')
                    ->type('start', '20')
                    ->type('start', '05')
                    ->type('start', '2022')
                    ->keys('#start', ['{tab}'])
                    ->type('start', '2000')
                    ->type('end', '21')
                    ->type('end', '05')
                    ->type('end', '2022')
                    ->keys('#end', ['{tab}'])
                    ->type('end', '2000')
                    ->select('category', 1)
                    ->click('@createsubmit')
                    ->assertUrlIs('http://127.0.0.1:8000/cms/agenda');
        });
    }
    public function testCategoryShow() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->click('@categories')
                    ->assertVisible('@cattitle');
        });
    }
    public function testCategoryCreate() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->click('@categories')
                    ->type('title', 'testcategory')
                    ->clickAndWaitForReload('@catcreatebutton')
                    ->assertSee('testcategory');
        });
    }
    public function testCategoryDelete() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit(new AgendaCMS)
                    ->click('@categories')
                    ->type('title', 'testcategory')
                    ->clickAndWaitForReload('@catdeletebutton')
                    ->assertUrlIs('http://127.0.0.1:8000/cms/agenda');
        });
    }
}
