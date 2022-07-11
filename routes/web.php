<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::controller(ClientController::class)
    ->middleware('auth')
    ->prefix('clients')
    ->group(function () {
        Route::get('/', 'index')->name('clients.index');
        Route::get('/create', 'create')->name('clients.create');
        Route::post('/store', 'store')->name('clients.store');
        Route::get('/edit/{client}', 'edit')->name('clients.edit');
        Route::post('/update/{client}', 'update')->name('clients.update');
        Route::post('/destroy/{client}', 'destroy')->name('clients.destroy');
    });

Route::controller(CompanyController::class)
    ->middleware('auth')
    ->prefix('companies')
    ->group(function () {
        Route::get('/', 'index')->name('companies.index');
        Route::get('/create', 'create')->name('companies.create');
        Route::post('/store', 'store')->name('companies.store');
        Route::get('/edit/{company}', 'edit')->name('companies.edit');
        Route::post('/update/{company}', 'update')->name('companies.update');
        Route::post('/destroy/{company}', 'destroy')->name('companies.destroy');
        Route::get('/search', 'search')->name('companies.search');
    });

Auth::routes();
