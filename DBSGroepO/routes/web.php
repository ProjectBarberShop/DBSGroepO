<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\NavbarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CardController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PreformanceController;
use App\Http\Controllers\FooterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('agenda', AgendaController::class)->only(['index']);
Route::resource('/optredens', PreformanceController::class);
Route::resource('/', HomeController::class)->only(['index']);
Route::resource('/contact', ContactController::class);
Auth::routes();

Route::get('/{slug}' , [WebPageController::class , 'show']);


Route::group([
    'prefix' => 'cms'
], function() {
    Route::get('/signout', function() {
        Session::flush();
        Auth::logout();
        return Redirect("/login");
    });
    Route::group(['middleware' => ['auth']], function() {
    Route::resource('fotos', FotoController::class)->only(['index']);
    Route::resource('contactpersonen', ContactsController::class);
    Route::resource('videos', FotoController::class)->only(['index']);
    Route::resource('profile', UserController::class)->only(['index']);
    Route::resource('youtube', YoutubeController::class);
    Route::controller(YoutubeController::class)->group(function(){
        Route::get('paginas/{pagina}/youtube/create' , 'createMultiple')->name('youtube.createMultiple');
        Route::post('paginas/{pagina}/youtube' , 'storeMultiple')->name('youtube.storeMultiple');
    });
    Route::resource('paginas', WebPageController::class);
    Route::controller(CardController::class)->group(function(){
        Route::get('paginas/{pagina}/card/create' , 'create')->name('card.create');
        Route::post('paginas/{pagina}/card' , 'store')->name('card.store');
    });
    Route::resource('footer', FooterController::class);
    Route::resource('navbar', NavbarController::class);
    Route::resource('dropdown', DropdownController::class);

    Route::get('/home', function () {
        return View::make('cms.home');
        });
    });
});
