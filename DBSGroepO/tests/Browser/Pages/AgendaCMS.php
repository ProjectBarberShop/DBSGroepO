<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class AgendaCMS extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/cms/agenda';
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
            '@createbutton' => '#createbutton',
            '@createsubmit' => '#createsubmit',
            '@cattitle' => '#cattitle',
            '@categories' => '#dLabel',
            '@catcreatebutton' => '#cataddbutton',
            '@catdeletebutton' => '#catdeletebutton',
            '@agendaeditbutton' => '#editbutton',
            '@agendaarchive' => 'div > div.content-wrapper > section > div > div > div:nth-child(5) > div.card-header > div > div:nth-child(3) > form > button > i'
        ];
    }
}
