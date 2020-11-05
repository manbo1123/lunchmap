<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <!-- BootStrapを導入 -->
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('scss/style.scss') }}">
    <style>body {padding-top: 80px;}</style>  <!-- 設置位置の調節  -->
    <title>Lunchmap</title>
    <script src='{{ asset("js/app.js") }}' defer></script>
  </head>
  <body>
    <!-- Bootstrap でナビバー導入 -->
    <nav class='navbar navbar-expand-md navbar-dark bg-dark fixed-top d-flex justify-content-between'>
      <div>
        <a class='navbar-brand' href='{{ route("shop.list") }}'>
          <i class="fas fa-map-pin"></i>
          <span class='h5'>Lunch Map</span>
        </a>
        @auth
          <span class="text-white-50">こんにちは、{{ Auth::user()->name }} さん</span>
        @endif
      </div>
      <div>
        @if (Route::has('login'))
          <div class="hidden fixed top-0 right-0 py-1 sm:block">
            @auth
              <div class="d-flex">
                <!-- ダッシュボード
                <a href="{{ url('/dashboard') }}" class="text-sm py-2">ダッシュボード</a>   -->

                <!-- プロフィール -->
                <x-jet-dropdown-link href="{{ route('profile.show') }}" class="text-info">
                  {{ __('Profile') }}
                </x-jet-dropdown-link>

                <!--  ログアウト -->
                <form method="POST" action="{{ route('logout') }}" class="py-2">
                  @csrf
                  <x-jet-dropdown-link href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    this.closest('form').submit();" class="text-info">
                    {{ __('Logout') }}
                  </x-jet-dropdown-link>
                </form>
                
              </div>
            @else
              <div class="py-2">
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline text-info">ログイン</a>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="mx-4 text-sm text-gray-700 underline text-info">アカウント作成</a>
                @endif
              </div>
            @endif
          </div>
        @endif
      </div>
    </nav>

    <div class = 'container'>
      @yield('content')
    </div>
  </body>
</html>