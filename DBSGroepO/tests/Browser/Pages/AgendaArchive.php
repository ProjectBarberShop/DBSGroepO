<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class AgendaArchive extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/cms/agenda/archived';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@deleteall' => 'div > div.content-wrapper > section > div > div > div.row.mb-2 > div.col-md-2 > form > button',
            '@back' => 'div > div.content-wrapper > section > div > div > div.row.mb-2 > div.col-md-1 > a'
        ];
    }
}
