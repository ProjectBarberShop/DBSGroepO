<?php

namespace Tests\Browser;

use App\Models\Agendapunt;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AgendaCMS;
use Tests\DuskTestCase;
use Carbon\Carbon;
use Tests\Browser\Pages\AgendaArchive;

class AgendaArchiveTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAgendaIndividualArchive()
    {
        $agendacount = Agendapunt::all()->where('isArchived', true)->count();
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(new AgendaCMS)
                    ->click('@agendaarchive');
        });
        //assert one more has been archived
        $this->assertGreaterThan($agendacount, Agendapunt::all()->where('isArchived', true)->count());
    }

    public function testAllArchive() {
        $agendacount = Agendapunt::all()->where('isArchived', false)->where('end', '<', Carbon::now())->count();
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(new AgendaCMS)
                    ->click('#createbutton');
        });
        $agendacount = Agendapunt::all()->where('isArchived', false)->where('end', '<', Carbon::now())->count();
        //assert all have been archived
        $this->assertEquals(0, $agendacount);
    }

    public function testBack()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(new AgendaArchive)
                    ->clickAndWaitForReload('@back')
                    ->assertPathIs('/cms/agenda');
        });
    }

    public function testDeleteAllArchived()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(new AgendaArchive)
                    ->click('@deleteall')
                    ->pause(200)
                    ->acceptDialog()
                    ->pause(1000);
        });
        //assert all have been deleted
        $agendacount = Agendapunt::all()->where('isArchived', true)->count();
        $this->assertEquals(0, $agendacount);
    }

}
