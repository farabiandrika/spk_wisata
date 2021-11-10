<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'prevent-back-history'],function(){
    Route::middleware(['auth'])->group(function () {
        Route::middleware(['isAdmin'])->group(function () {
            Route::get('/data-user', [PagesController::class, 'dataUser']);
            Route::get('/data-kriteria', [PagesController::class, 'dataKriteria']);
            Route::get('/data-alternatif', [PagesController::class, 'dataAlternatif']);
        });
     
        Route::middleware(['isUser'])->group(function () {
            Route::get('/biodata', [PagesController::class, 'biodata']);
            Route::get('/perhitungan', [PagesController::class, 'perhitungan']);
            // Route::get('/wisata', [PagesController::class, 'wisata']);
        });
     
        Route::get('/logout', function() {
            Auth::logout();
            return redirect('/login');
        });

        Route::get('/home', [PagesController::class, 'home']);

    });
    Route::get('/', [PagesController::class, 'landing']);

	Auth::routes([
        'register' => true, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);

    
});