<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ShopController; 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
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

Route::resource('/shop', ShopController::class)->except(['index'])->names([
    'show' => 'shop.detail',
    'create' => 'shop.new'
]);
Route::get('/shops', [ShopController::class, 'index'])->name('shop.list');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Admin 関連
Route::prefix('admin')->group(function () {
    // 認証不要なルーティング
    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);
    // 認証が必要なルーティング
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/', function () { return redirect('/admin/dashboard'); });
        Route::get('logout', [LoginController::class, 'destroy'])->name('admin.logout');
    });
});

// SNS認証
Route::prefix('login/{provider}')->where(['provider' => '(line|twitter|facebook|google|yahoo)'])->group(function(){
    Route::get('/', [App\Http\Controllers\LoginController::class, 'redirectToProvider'])->name('social_login.redirect');
    Route::get('/callback', [App\Http\Controllers\LoginController::class, 'handleProviderCallback'])->name('social_login.callback');
});