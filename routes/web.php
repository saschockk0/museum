<?php

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');


Route::name('profile.')->prefix('profile')->group(function(){
    Route::get('/index', [App\Http\Controllers\ProfileController::class, 'index'])->name('index')->middleware('auth');
    Route::get('/settings', [App\Http\Controllers\ProfileController::class, 'settings'])->name('settings')->middleware('auth');
    Route::get('/excurs', [App\Http\Controllers\ProfileController::class, 'excurs'])->name('excurs')->middleware('auth');
    Route::get('/exhib', [App\Http\Controllers\ProfileController::class, 'exhib'])->name('exhib')->middleware('auth');



    Route::get('/excurs/delete/{id}', [App\Http\Controllers\ProfileController::class, 'excursDelete'])->name('excursDelete')->middleware('auth');
    Route::get('/exhib/delete/{id}', [App\Http\Controllers\ProfileController::class, 'exhibDelete'])->name('exhibDelete')->middleware('auth');

    Route::put('/settings/changePassword', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('changePassword')->middleware('auth');
    Route::post('/settings/image', [App\Http\Controllers\ProfileController::class, 'image'])->name('image')->middleware('auth');
});

Route::name('exhib.')->prefix('exhib')->group(function(){
    Route::get('/index', [App\Http\Controllers\ExhibController::class, 'index'])->name('index');
    Route::get('/show/{id}', [App\Http\Controllers\ExhibController::class, 'showExhib'])->name('showExhib');
    Route::get('/search', [App\Http\Controllers\ExhibController::class, 'search'])->name('search');
    Route::get('/writeExhib/{id}', [App\Http\Controllers\ExhibController::class, 'writeExhib'])->name('writeExhib')->middleware('auth');
    Route::get('/status/{id}', [App\Http\Controllers\ExhibController::class, 'changeStatus'])->name('changeStatus')->middleware('admin');
});

Route::name('admin.')->prefix('admin')->group(function(){
    Route::get('/index', [App\Http\Controllers\AdminController::class, 'index'])->name('index')->middleware('admin');
    Route::post('/roles', [App\Http\Controllers\AdminController::class, 'roles'])->name('roles')->middleware('admin');

    Route::post('/createExcurs', [App\Http\Controllers\AdminController::class, 'createExcurs'])->name('createExcurs')->middleware('admin');
    Route::post('/createExhib', [App\Http\Controllers\AdminController::class, 'createExhib'])->name('createExhib')->middleware('admin');

    Route::get('/excurs/delete/{user}/{excurs}', [App\Http\Controllers\AdminController::class, 'excursDeleteUser'])->name('excursDeleteUser')->middleware('admin');
    Route::get('/exhib/delete/{user}/{exhib}', [App\Http\Controllers\AdminController::class, 'exhibDeleteUser'])->name('exhibDeleteUser')->middleware('admin');
});

Route::name('excursions.')->prefix('excursions')->group(function(){
    Route::get('/index', [App\Http\Controllers\ExcursionController::class, 'index'])->name('index');
    Route::get('/show/{id}', [App\Http\Controllers\ExcursionController::class, 'showExcursion'])->name('show');
    Route::get('/search', [App\Http\Controllers\ExcursionController::class, 'search'])->name('search');
    Route::get('/writeExcurs/{id}', [App\Http\Controllers\ExcursionController::class, 'writeExcurs'])->name('writeExcurs')->middleware('auth');
    Route::get('/status/{id}', [App\Http\Controllers\ExcursionController::class, 'changeStatus'])->name('changeStatus')->middleware('admin');
});



Route::get('/logout', function () {
    Session::flush();
    Auth::logout();
    return redirect()->route('main');
})->middleware('auth');
