<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\AgendaCMSController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\NewsletterController;

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

Route::get('/agenda', [AgendaController::class , 'index'])->name('webpage_agenda.index');
Route::resource('/optredens', PerformanceController::class);
Route::resource('/', HomeController::class)->only(['index']);
Route::resource('/contact', ContactFormController::class);
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
    Route::resource('fotos', ImageController::class);
    Route::resource('contactpersonen', ContactsController::class);
    Route::resource('videos', FotoController::class)->only(['index']);
    Route::resource('profile', UserController::class)->only(['index']);
    Route::resource('youtube', YoutubeController::class)->except('update');
    Route::resource('nieuwsbrieven', NewsletterController::class);
    Route::controller(NewsletterController::class)->group(function(){
        Route::get('/nieuws', 'getNews')->name('nieuws');
    });
    Route::resource('youtube', YoutubeController::class);
    Route::controller(YoutubeController::class)->group(function(){
        Route::put('youtube/{youtube}/{id}' , 'update')->name('youtube.update');
        Route::get('paginas/{pagina}/youtube/create' , 'createMultiple')->name('youtube.createMultiple');
        Route::post('paginas/{pagina}/youtube' , 'storeMultiple')->name('youtube.storeMultiple');
    });
    Route::resource('paginas', WebPageController::class);
    Route::resource('agenda', AgendaCMSController::class)->only(['index']);
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
