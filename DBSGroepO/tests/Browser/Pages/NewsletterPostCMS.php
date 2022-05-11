<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class NewsletterPostCMS extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/cms/nieuwsbrieven';
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
            '@selectedImage' => '.modal-content a:nth-child(1)',
            '@addNews' => '#addNews',
            '@editNews' => '#editNews',
            '@removeNews' => '.row:nth-child(1) .card:nth-child(1) #remove',
        ];
    }
}
