<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::group(['middleware'=>['auth','checklevel:admin,kasir']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::group(['middleware'=>['auth','checklevel:admin']], function(){
    Route::resource('product', ProductController::class);
    Route::resource('kategori', KategoriController::class);
});
Route::group(['middleware'=>['auth','checklevel:kasir']], function(){
    Route::resource('transaction', TransactionController::class);
    Route::get('/list-product', [App\Http\Controllers\TransactionController::class, 'listProduct'])->name('list-product');
});
