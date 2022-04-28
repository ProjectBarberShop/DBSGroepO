<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateWebpageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testUpdatePage()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->press('#login');
            $browser->assertPathIs('/login');
            $browser->type('email', 'admin@gmail.com');
            $browser->type('password', 'Admin123');
            $browser->press('Login');
            $browser->assertPathIs('/cms/home');
            $browser->assertVisible('#paginas')
            ->visit(
                        $browser->attribute('#paginas' , 'href')
            );
            $browser->assertPathIs('/cms/paginas');
            $browser->press('#update1');
            $browser->assertPathIs('/cms/paginas/1/edit');
            $browser->waitFor('#body_ifr');
            $browser->driver->executeScript('tinyMCE.get(\'body\').setContent(\'<p>Test body</p>\')');
            $browser->type('title', 'testlink1');
            $browser->select('navItem' , '0');
            $browser->press('Submit');
            $browser->assertPathIs('/cms/paginas/1/column/update');
            $browser->waitFor('#textarea1_ifr');
            $browser->driver->executeScript('tinyMCE.get(\'textarea1\').setContent(\'<p>Test column test</p>\')');
            $browser->type('collomMainText[1][colom_title_text]', 'testen');
            $browser->type('collomMainText[2][colom_title_text]', 'testen2');
            $browser->press('add');
            $browser->pause(2000);
            $browser->press('#delete1');
            $browser->press('add');
            $browser->type('multiInput[2][colom_title_text]', 'hoi');
            $browser->driver->executeScript('tinyMCE.get(\'columtext2\').setContent(\'<p>Test column test 2000</p>\')');
            $browser->press('Update');
            $browser->assertPathIs('/cms/paginas/1/youtube/edit');
            $browser->type('oldInput[1][youtube_video_key]', 'lSxh-Uk7Ays');
            $browser->press('Update');
            $browser->assertPathIs('/cms/paginas');
            $browser->pause(2000);

        });

    }
}
