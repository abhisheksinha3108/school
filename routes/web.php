<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;

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



Route::get('/',[FrontendController::class,'index'])->name('home');

Route::get('/about',[FrontendController::class,'about'])->name('about');

Route::get('/admission',[FrontendController::class,'admission'])->name('admission');

Route::get('/contact',[FrontendController::class,'contact'])->name('contact');

Route::get('/whyus',[FrontendController::class,'whyus'])->name('whyus');

// Route::get('/about', function () {
//     return view('frontend.about');
// })->name('about');

// Route::get('/admission', function () {
//     return view('frontend.admission');
// })->name('admission');

// Route::get('/contact', function () {
//     return view('frontend.contact');
// })->name('admission');

// Route::get('/whyus', function () {
//     return view('frontend.why');
// })->name('why');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



// Admin 
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        // login route
        Route::get('login','AuthenticatedSessionController@create')->name('login');
        Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
    });
    Route::middleware('admin')->group(function(){
        Route::get('dashboard','HomeController@index')->name('dashboard');

        Route::get('admin-test','HomeController@adminTest')->name('admintest');
        Route::get('editor-test','HomeController@editorTest')->name('editortest');

        Route::resource('posts','PostController');

    });
    Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
});






