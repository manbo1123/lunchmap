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

Route::get('/', function () {
    return redirect('/shops');
});

Route::resource('/shop', App\Http\Controllers\ShopController::class)->except(['index'])->names([
    'show' => 'shop.detail',
    'create' => 'shop.new'
]);
Route::get('/shops', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.list');
