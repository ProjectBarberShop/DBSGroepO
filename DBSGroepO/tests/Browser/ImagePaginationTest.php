<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ImagePagination;
use Tests\DuskTestCase;

class ImagePaginationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNewsPaperPagination()
    {
        // deze test heeft meer dan 5 images nodig
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(new ImagePagination)
                    ->assertPresent('@paginator');
        });
    }

    public function testPaginationRequest() {
        $response = $this->actingAs(User::find(1))->json('GET', 'cms/fotos/fetch_data?page=2');
        $response->assertStatus(200);
    }

    public function testPaginationButton() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(new ImagePagination)
                    ->click('@modaltoggle')
                    ->pause(100)
                    ->click('@paginatornext')
                    ->assertSee('Selecteer foto');
        });
    }
}
