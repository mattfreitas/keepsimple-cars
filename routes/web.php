<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TipController;
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

Route::get('/', HomeController::class);

Route::group(['prefix' => 'tip', 'as' => 'tips.'], function () {
    Route::get('/create', [ TipController::class, 'create' ])->name('create');
    Route::post('/create', [ TipController::class, 'store' ])->name('store');
    Route::get('/{tip}/edit', [ TipController::class, 'edit' ])->name('edit');
    Route::patch('/{tip}/edit', [ TipController::class, 'update' ])->name('update');
    Route::delete('/{tip}/delete', [ TipController::class, 'destroy' ])->name('destroy');
});

Route::group(['prefix' => 'account', 'as' => 'accounts.'], function () {
    Route::get('/', [ AccountController::class, 'index' ])->name('index');
});

require __DIR__.'/auth.php';
