<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Footer;
use App\Models\NavbarItem;
use Database\Seeders\FooterSeeder;
use Database\Seeders\NavbarSeeder;
use App\Models\Newsletter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function($view) {
            $newsletterdata = Newsletter::with('image')
            ->orderBy('created_at', 'desc')
            ->where('is_published', true)->first();
            $contactsdata = Contact::where('is_published', true)->get();
            $footerdata = Footer::find(1);
            $navbardata = NavbarItem::orderBy('number')->get();

            if($footerdata == null){
                $seeder = new FooterSeeder();
                $seeder->run();
                $footerdata = Footer::find(1);
            }

            if($navbardata == null){
                $seeder = new NavbarSeeder();
                $seeder->run();
                $navbardata = NavbarItem::orderBy('number')->get();
            }

            $view->with(['newsletterdata' => $newsletterdata,
                         'contactsdata' => $contactsdata,
                         'footerdata' => $footerdata,
                         'navbardata' => $navbardata,
                        ]);
        });
        Paginator::useBootstrap();
    }
}
