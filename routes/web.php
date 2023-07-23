<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::middleware([config('jetstream.auth_session'),'admin'])->group(function () {

        Route::prefix('user')->controller(UserController::class)->group(function () {
            
            Route::get('index','index')->name('admin.user.list');
            Route::post('store','store')->name('admin.user.store');
            Route::post('update/{id}','update')->name('admin.user.update');
            Route::get('delete/{id}','delete')->name('admin.user.delete');
        });
        
    });

    
});
