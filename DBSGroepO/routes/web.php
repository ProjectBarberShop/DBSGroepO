<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\WebPageController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PreformanceController;

use App\Http\Controllers\ContactController;
use App\Http\Requests\ContactFormRequest;

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

Route::resource('optredens', PreformanceController::class)->only(['index']);
Route::resource('agenda', AgendaController::class)->only(['index']);
Route::resource('/', HomeController::class)->only(['index']);
Auth::routes();


Route::get('/contact-us', 
[ContactController::class, 'contact']);
Route::post('/contact-us', 
    [ContactController::class, 'storeMessage'])->name('validate.form');

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
    Route::resource('contact', FotoController::class)->only(['index']);
    Route::resource('videos', FotoController::class)->only(['index']);
    Route::resource('profile', UserController::class)->only(['index']);
    Route::resource('paginas', WebPageController::class);
    Route::get('/home', function () {
        return View::make('cms.home');
        });
    });
});
