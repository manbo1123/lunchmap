<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    // SNS側へのリダイレクト
    public function redirectToProvider(Request $request) {
        $provider = $request->provider;    // 複数のSNSプロバイダを使うことを想定して、直書きしないでおく
        return Socialite::driver($provider)->redirect();
    }

    // SNS側から帰ってくるページ
    public function handleProviderCallback(Request $request) {
        $provider = $request->provider;
        $social_user = Socialite::driver($provider)->user();
        // メルアドレスと名前情報を取得
        $social_email = $social_user->getEmail();
        $social_name = $social_user->getName();

        // 登録済ならログイン。未登録ならアカウント登録してログイン
        if(!is_null($social_email)) {
            $user = User::firstOrCreate(
                [ 'email' => $social_email ],
                [ 'email' => $social_email, 'name' => $social_name, 'password' => Hash::make(Str::random())
            ]);
            auth()->login($user);
            session()->flash('oauth_login', $provider.'でログインしました。');
            return redirect('/shops');
        }
        return '情報が取得できませんでした。';
    }
}
