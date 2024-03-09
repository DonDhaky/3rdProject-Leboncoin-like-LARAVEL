<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::controller(App\Http\Controllers\AdsController::class)->group(function () {
    Route::get('/ads', 'index')->middleware('admin');
    Route::get('/create_ad', 'create')->name('ads.create');
    Route::post('/create_ad', 'store')->name('ads.store');
    Route::get('/edit_ad/{one_ad_id}', 'edit')->name('ads.edit');
    Route::put('/edit_ad/{one_ad_id}', 'update')->name('ads.update');
    Route::get('/delete_ad/{one_ad_id}', 'delete')->name('ads.delete');
    Route::get('/', 'show')->name('home');
});

