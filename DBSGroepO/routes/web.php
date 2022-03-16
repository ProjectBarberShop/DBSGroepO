<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreformanceController;

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
Auth::routes();


Route::get('/contact-us', 
[ContactController::class, 'contact']);
Route::post('/contact-us', 
    [ContactController::class, 'storeMessage'])->name('validate.form');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

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
    Route::resource('paginas', WebPageController::class);
    Route::get('/home', function () {
        return View::make('cms.home');
        });
    });
});

