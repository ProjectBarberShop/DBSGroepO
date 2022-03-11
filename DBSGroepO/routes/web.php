<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\FotoController;


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

Route::get('/', function () {
    return view('Home/home');
});
Auth::routes();

Route::group([
    'prefix' => 'barbershop'
], function() {
    Route::resource('home', HomeController::class)->only(['index']);
});

Route::group([
    'prefix' => 'cms'
], function() {
    Route::get('signout', function() {
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