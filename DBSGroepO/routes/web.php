<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\CardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ImageController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\AgendaCMSController;
use App\Http\Controllers\ColumnTextController;
use App\Http\Controllers\LearnToSingCategorie;

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\LearnToSingCMSController;
use App\Http\Controllers\LearnToSingController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TicketCMSController;
use App\Http\Controllers\TicketController;

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
Route::resource('/learntosing', LearntosingController::class);
Route::get('/nieuws', [NewsletterController::class, 'getNews'])->name('nieuws.index');
Route::controller(TicketController::class)->group(function() {
    Route::get('/boeking', 'index')->name('boeking.index');
    Route::get('/boeking/send/{id}', 'send')->name('ticket.send');
});

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

        Route::controller(ImageController::class)->group(function(){
            Route::get('paginas/{pagina}/afbeelding/create', 'createMultiple')->name('Afbeelding.createMultiple');
            Route::post('paginas/{pagina}/afbeelding', 'storeMultiple')->name('Afbeelding.storeMultiple');
            Route::get('paginas/{pagina}/afbeelding/edit' , 'editImage')->name('imageWebpage.editImage');
            Route::post('paginas/{pagina}/afbeelding/update' , 'updateImage')->name('imageWebpage.updateImage');
        });
    Route::controller(ImageController::class)->group(function() {
        Route::get('fotos/fetch_data', 'fetch_data')->name('fotos.fetchdata');
    });
    Route::resource('fotos', ImageController::class);
    Route::resource('contactpersonen', ContactsController::class);
    Route::resource('learntosing/categorie', LearnToSingCategorie::class);

    Route::resource('profile', UserController::class)->only(['index']);

    Route::controller(ContactFormController::class)->group(function(){
        Route::get('contactverzoeken', 'getContactRequests')->name('contactverzoeken.index');
        Route::delete('/contactverzoeken/{id}', 'destroy')->name('contactverzoeken.destroy');
    });


    Route::resource('nieuwsbrieven', NewsletterController::class);
    Route::resource('youtube', YoutubeController::class)->except('update');

    Route::controller(YoutubeController::class)->group(function() {
        Route::put('youtube/{youtube}/{id}', 'update')->name('youtube.update');
        Route::get('paginas/{pagina}/youtube/create', 'createMultiple')->name('youtube.createMultiple');
        Route::post('paginas/{pagina}/youtube', 'storeMultiple')->name('youtube.storeMultiple');
        Route::get('paginas/{pagina}/youtube/edit' , 'editYoutube')->name('youtubeWebpage.editYoutube');
        Route::post('paginas/{pagina}/youtube/update' , 'updateAndInsert')->name('youtubeWebpage.updateYoutube');
    });

    Route::resource('paginas', WebPageController::class);
    Route::controller(WebpageController::class)->group(function() {
        Route::post('paginas/{pagina}/duplicate' , 'duplicatePage')->name('paginas.duplicate');
        Route::put('paginas/update/{id}', 'updateTemplate')->name('paginas.updateTemplate');
        Route::delete('paginas/removeTemplate/{id}', 'removeTemplate')->name('paginas.removeTemplate');
        Route::get('paginas/afbeeldingen/{webpageID}', 'showAllImagesWebpage')->name('paginas.getAllImagesWebpage');
        Route::delete('paginas/afbeeldingen/{webpageID}/{imageId}', 'destroyImage')->name('paginas.destroyImage');
    });

    Route::controller(CategoryController::class)->group(function() {
        Route::put('category/updatecolor', 'updatecolor')->name('category.updatecolor');
        Route::put('category/updatetext', 'updatetext')->name('category.updatetext');
    });

    Route::resource('category', CategoryController::class);

    Route::controller(ColumnTextController::class)->group(function() {
        Route::post('paginas/{pagina}/column', 'updateAndStore')->name('editColomText.updateAndInsert');
        Route::get('paginas/{pagina}/column/update', 'edit')->name('editColomText.edit');
        Route::delete('paginas/{collomtext}/column/{page}', 'destroy')->name('column.destroy');
    });

    Route::controller(NavbarController::class)->group(function() {
        Route::post('navbar/change/{id}' , 'changeOrder')->name('navbar.order');
    });

    Route::controller(AgendaCMSController::class)->group(function() {
        Route::get('agenda/archived', 'getArchived')->name('agenda.archived');
        Route::delete('agenda/deletearchive/{id}', 'deleteArchived')->name('agenda.deletearchived');
        Route::delete('agenda/deleteallarchived', 'deleteAllArchived')->name('agenda.deleteallarchived');
        Route::get('agenda/archiveall', 'ArchiveAll')->name('agenda.archiveall');
        Route::put('agenda/archive/{id}', 'ArchiveSingle')->name('agenda.archive');
    });
    Route::resource('agenda', AgendaCMSController::class);

    Route::resource('footer', FooterController::class);
    Route::resource('navbar', NavbarController::class);
    Route::resource('dropdown', DropdownController::class);
    Route::resource('learntosing-beheer', LearnToSingCMSController::class);

    Route::resource('tickets', TicketCMSController::class);


    Route::get('/home', function () {
        return View::make('cms.home');
        });
    });
});
