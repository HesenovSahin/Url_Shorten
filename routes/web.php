<?php

use App\Http\Controllers\UrlShortController;
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


Route::get('/url/{url}',[UrlShortController::class,'getData']);

Route::post('/generate',[UrlShortController::class,'store'])->name('generate');

Route::get('/{id}', [UrlShortController::class, 'getData'])->name('getData');

Route::get('/',[UrlShortController::class,'form'])->name('home');