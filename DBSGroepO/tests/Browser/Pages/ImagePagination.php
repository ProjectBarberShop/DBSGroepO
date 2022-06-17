<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class ImagePagination extends Page
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
            '@paginator' => '#modal-info > div.modal-dialog-scrollable.d-flex.justify-content-center.align-content-center > div > div.modal-body.row.m-0.h-100 > nav > ul',
            '@paginatornext' => '#modal-info > div.modal-dialog-scrollable.d-flex.justify-content-center.align-content-center > div > div.modal-body.row.m-0.h-100 > nav > ul > li:nth-child(3) > a',
            '@modaltoggle' => 'div > div.content-wrapper > section > div > div:nth-child(2) > div > div > div.card-body > button'
        ];
    }
}
