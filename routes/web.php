<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

// 確認メール送信画面
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');
// 確認リンクをクリック時
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/shops');
})->middleware(['auth', 'signed'])->name('verification.verify');
// 確認メールの再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// PWリセット画面表示
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');          //  email入力フォーム
})->middleware(['guest'])->name('password.request');
// PWリセットフォームの送信
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    // リクエストに関するメッセージ
    $status = Password::sendResetLink( $request->only('email') );
    return $status === Password::RESET_LINK_SENT
              ? back()->with(['status' => __($status)])
              : back()->withErrors(['email' => __($status)]);
})->middleware(['guest'])->name('password.email');
// PWリセットの実行
Route::get('/reset-password/{token}', function (Request $request, $token) {
    return view('auth.reset-password', ['request'=>$request, 'token' => $token]);
})->middleware(['guest'])->name('password.reset');

// 新しいPW入力フォーム送信
Route::post('/reset-password', function (Request $request) {
    $request->validate([ 'token' => 'required', 'email' => 'required|email', 'password' => 'required|min:8|confirmed', ]);
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([ 'password' => Hash::make($password) ])->save();
            $user->setRememberToken(Str::random(60));
            event(new PasswordReset($user));
        }
    );
    return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
})->middleware(['guest'])->name('password.update');