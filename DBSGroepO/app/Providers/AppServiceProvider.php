<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Footer;
use Database\Seeders\FooterSeeder;
use Illuminate\Support\ServiceProvider;

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
            $contactsdata = Contact::where('is_published', true)->get();
            $footerdata = Footer::find(1);

            if($footerdata == null){
                $seeder = new FooterSeeder();
                $seeder->run();
                $footerdata = Footer::find(1);
            }

            $view->with(['contactsdata' => $contactsdata,
                         'footerdata' => $footerdata]);
        });
    }
}
