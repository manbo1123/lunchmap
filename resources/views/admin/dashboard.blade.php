@extends('layout')

@section('content')
    <div class = 'container'>
        <div class="d-flex">
            <h1>Página de administrador!!!</h1>
        </div>
        <p>¡Hola! {{ Auth::user()->name }}</p>
        <a href="{{ route('shop.list') }}" class="btn btn-outline-secondary">
            <i class="fas fa-home fa-2x"></i>
        </a>
    </div>

    <div>
        <div class="hidden fixed top-0 right-0 py-1 sm:block">
            <div class="d-flex">
                <!--  ログアウト -->
                <form method="POST" action="{{ route('logout') }}" class="py-2">
                    @csrf
                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <table class='table table-striped table-hover'>
    <tr>
      <th>店名</th>
      <th>申請ユーザー</th>
      <th>承認</th>
    </tr>
    
    @foreach ($shops as $shop)
      <tr>
        <td>
          <a href='{{ route("shop.detail", ["shop"=>$shop->id]) }}'>{{ $shop->name }}</a>
        </td>

        <td>{{ $shop -> user -> name }}</td>
        <td>
          @if ($shop->status == "1")
            {{ Form::open(['method' => 'post', 'route' => ['admin.accept', $shop->id] ]) }}
              {{ Form::submit('登録', ['class' => 'btn btn-sm btn-outline-primary']) }}
            {{ Form::close() }}
          @elseif ($shop->status == "2")
            {{ Form::open(['method' => 'delete', 'route' => ['admin.destroy', $shop->id] ]) }}
              {{ Form::submit('削除', ['class' => 'btn btn-sm btn-outline-danger']) }}
            {{ Form::close() }}
          @endif
        </td>
      <tr>
    @endforeach
  </table>
@endsection

