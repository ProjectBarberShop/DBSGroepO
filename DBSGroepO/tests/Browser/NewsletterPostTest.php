<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Tests\Browser\Pages\NewsletterPostCMS;

class NewsletterPostTest extends DuskTestCase
{
    public function testLogin() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit(new NewsletterPostCMS)
                ->assertPathIs('/cms/nieuwsbrieven');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateNewsletterPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->scrollTo('.row:nth-child(2)')
            ->pause(2000)
            ->press('Selecteer foto')
            ->press('@selectedImage')
            ->type('title', 'Nieuwsbrief')
            ->type('message', "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Fusce ut tortor blandit, tincidunt neque vitae, vulputate erat.
            Aenean facilisis ornare dolor ac tincidunt.
            Fusce eu ex vel eros maximus egestas ac non lacus.
            Quisque egestas lacinia justo at scelerisque.
            Nam porta, libero ac euismod ultricies, risus massa convallis lorem,
            eget tincidunt odio lectus eu orci. Cras egestas eros consectetur magna congue bibendum.
            Aenean vulputate rutrum nisi, eu vestibulum orci volutpat in.")
            ->scrollTo('@addNews')
            ->pause(2000)
            ->press('Nieuwsbrief toevoegen');
        });
    }

    public function testEditNewsletterPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Bijwerken')
            ->press('Selecteer foto')
            ->press('@selectedImage')
            ->scrollTo('@editNews')
            ->pause(2000)
            ->type('title', 'Nieuwsbrief bijgewerkt')
            ->type('message', "Cras congue mollis lectus sed finibus. Nunc id sem arcu.
            Vivamus et purus ut arcu viverra tempor. Nam nec turpis tortor.
            Aliquam sit amet magna a justo volutpat semper in eget velit.
            Mauris facilisis tortor quis nulla eleifend sollicitudin.
            In tortor leo, mollis porttitor blandit eget, sollicitudin feugiat tortor.
            Aenean eget efficitur leo, id viverra lorem.
            Donec a est eu arcu faucibus volutpat non at ante.
            Donec a libero vitae tellus pulvinar ultricies sit amet ut libero.
            Etiam luctus accumsan orci id semper.
            Fusce sem mauris, laoreet nec erat quis, suscipit vulputate massa.
            Suspendisse quis lacus mattis, euismod sem at, porta est.
            Nunc ullamcorper bibendum ante, at tincidunt libero semper ac.")
            ->check('ispublished')
            ->press('Nieuwsbrief bijwerken')
            ->assertPathIs('/cms/nieuwsbrieven')
            ->pause(5000);
        });
    }

    public function testDeleteNewsletterPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->scrollTo('@removeNews')
            ->pause(2000)
            ->press('@removeNews')
            ->pause(2000)
            ->acceptDialog();
        });
    }
}
