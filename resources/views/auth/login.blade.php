<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">   <!-- ロゴ表示（ / へのリンク） -->
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if (Request::is('admin/login'))
            <p class="text-center text-green-600">管理者用</p>
        @endif

        <!-- $guardがセットされてるか？で送信先を条件分岐 -->
        <form method="POST" action="{{ isset($guard) ? route('admin.login') : route('login') }}">
            @csrf

            <div>   <!-- メールアドレス入力フォーム -->
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">   <!-- PW入力フォーム -->
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">   <!-- Remember meのチェックボックス -->
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <div class="text-right">
                    @if (Route::has('password.request'))      <!-- PW忘れた？リンク（リンク先：/forgot-password） -->
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a><br>
                    @endif

                    @if (!Request::is('admin/login'))     <!-- 管理者ログインページへのリンク -->
                        <a href='{{ route("admin.login") }}' class="underline text-sm text-gray-600 test-right">管理者はこちら</a>
                    @else
                        <a href='{{ route("login") }}' class="underline text-sm text-gray-600 test-right">管理者でない方</a>
                    @endif
                </div>
                <x-jet-button class="ml-4">   <!-- ログインボタン -->
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
        <hr class="py-1 ">        <!-- SNS認証 -->
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-between py-1"> 
                <div class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <a href="{{ route('social_login.redirect', 'twitter') }}">
                        <i class="fab fa-twitter"></i>
                        Twitter でログイン
                    </a>
                </div>
                <div class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <a href="{{ route('social_login.redirect', 'facebook') }}">
                        <i class="fab fa-facebook-f"></i>
                        Facebook でログイン
                    </a>
                </div>
            </div>
            <!--
            <div class="d-flex justify-content-between">
                <div class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <a href="{{ route('social_login.redirect', 'google') }}">
                        <i class="fab fa-google"></i>
                        Google でログイン
                    </a>
                </div>
                <div class="inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-300 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <a href="{{ route('social_login.redirect', 'yahoo') }}">
                        <i class="fab fa-yahoo"></i>
                        Yahoo でログイン
                    </a>
                </div>
            </div> -->
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
