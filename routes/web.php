<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Models\UserEvent;
use App\Models\Event;
use App\Models\EventType;

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
    return redirect('/home');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

//Routes admin
Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::get('/home', [AdminController::class, 'index']);

    Route::get('/calendario', [EventController::class, 'index']);
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::patch('/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    Route::get('/tipos-eventos', [EventTypeController::class, 'index']);
    Route::post('/tipos-eventos/store', [EventTypeController::class, 'store'])->name('eventtype.store');
    Route::patch('/tipos-eventos/update/{id}', [EventTypeController::class, 'update'])->name('eventtype.update');
    Route::delete('/tipos-eventos/destroy/{id}', [EventTypeController::class, 'destroy'])->name('eventtype.destroy');



    Route::get('/usuarios', [AdminController::class, 'getUsers']);
    Route::post('/usuarios/store', [AdminController::class, 'store'])->name('user.store');
    Route::patch('/usuarios/update/{id}', [AdminController::class, 'update'])->name('user.update');
    Route::delete('/usuarios/destroy/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
    Route::get('/usuarios/datatable-users', [AdminController::class, 'getUsersDatatable'])->name('user.datatable');
});

//Routes admin
Route::group([
    'middleware' => 'user',
    'prefix' => 'user',
    'namespace' => 'user'
], function () {
    Route::get('/home', [UserController::class, 'index']);
});
