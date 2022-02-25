<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\WebPageController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});
Auth::routes();

Route::group([
    'prefix' => 'cms'
], function() {
    Route::get('signout', function() {
        Session::flush();
        Auth::logout();
        return Redirect("/login");
    });
    Route::group(['middleware' => ['auth']], function() {
       
        Route::get('/fotos' , [FotoController::class , 'index']);
        Route::get('/contact' , [FotoController::class , 'index']);
        Route::get('/videos' , [FotoController::class , 'index']);
        Route::get('/profile' , [UserController::class , 'index']);
        Route::get('/paginas' , [WebPageController::class , 'index']);

        Route::get('/home', function () {
            return View::make('cms.home');
        });
    });
});

