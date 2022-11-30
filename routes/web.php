<?php

use Illuminate\Support\Facades\Route;
use JeroenDesloovere\VCard\VCard;


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
    return view('form');
});

Route::post('/download-vcf', [App\Http\Controllers\AuthController::class, 'downloadVCF'])->name('download-vcf');

