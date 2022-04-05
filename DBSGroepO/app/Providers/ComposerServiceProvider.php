<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use app\Composers\SidebarComposer;
use App\Models\Agendapunt;

class ComposerServiceProvider extends ServiceProvider {

    public function boot()
    {
        
        View::composer('*', function($view){
            $preformances = Agendapunt::all();
            $view->with('schedules', $preformances);
        });
    }


    public function register()
    {
        //
    }
}