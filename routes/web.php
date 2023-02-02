<?php

use App\Http\Controllers\GuestGiftController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'AdminRoutes'], function(){

    Route::get('/users/all', [UserController::class, 'index'])->name('user.index');
    Route::get('/collection',[GuestGiftController::class, 'index'])->name('collection.index');
    Route::get('/collection/create',[GuestGiftController::class, 'create'])->name('collection.create');
    Route::post('/collection/store',[GuestGiftController::class, 'store'])->name('collection.store');
    Route::get('/collection/delete/{id}',[GuestGiftController::class, 'delete'])->name('collection.delete');

    // Exporting
    Route::get('/data/export/pdf', [ImportExportController::class, 'exportPDF'])->name('data.export.pdf');
});