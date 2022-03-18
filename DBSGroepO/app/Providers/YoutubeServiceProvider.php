<?php

namespace App\Providers;

use App\View\Components\YoutubeComponent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class YoutubeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('youtube-video', YoutubeComponent::class);
    }
}
