<?php

namespace App\Providers;

use App\Http\Controllers\NewsletterController;
use App\Models\Contact;
use App\Models\Footer;
use App\Models\Newsletter;
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
            $newsletterdata = Newsletter::orderBy('created_at', 'desc')->where('is_published', true)->first();
            $contactsdata = Contact::where('is_published', true)->get();
            $footerdata = Footer::find(1);
            $view->with(['contactsdata' => $contactsdata,
                         'footerdata' => $footerdata,
                         'newsletterdata' => $newsletterdata,
                        ]);
        });
    }
}
