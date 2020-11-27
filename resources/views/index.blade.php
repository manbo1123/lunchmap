@extends('layout')

@section('content')
  <div class="d-flex justify-content-between">
    <h1>お店一覧</h1>
    @auth('web')   <!-- ユーザーログイン時のみ登録ボタンを表示 -->
      <div>
        <a href='{{ route("shop.new") }}', class="btn btn-outline-primary">お店を登録</a>
      </div>
    @endauth
  </div>

  <table class='table table-striped table-hover'>
    <tr>
      <th></th>
      <th>カテゴリー</th>
      <th>店名</th>
      <th><i class="fas fa-map-marked-alt fa-lg"></i></th>
      <th><i class="fas fa-user fa-lg"></i></th>
    </tr>
    
    @foreach ($shops as $shop)
      @if (!($shop -> status == 0) && !($shop -> user_id == Auth::id()) && !(Auth::guard('admin')->user()))
        @continue
      @endif

      <tr>
        <td>
            @if ( !$shop -> status == 0  && $shop -> user_id == Auth::id() )
              <p>承認待ち</p>
            @elseif ( !$shop -> status == 0  && Auth::guard('admin')->user() )
              <a href = '{{ route("admin.dashboard") }}', class='btn btn-sm btn-outline-primary'>要承認</a>
            @endif
        </td>

        <td>{{ $shop -> category -> name }}</td>

        <td>
          <a href='{{ route("shop.detail", ["shop"=>$shop->id]) }}'>{{ $shop->name }}</a>
        </td>

        <td>{{ $shop -> address }}</td>
        <td>{{ $shop -> user -> name }}</td>
      <tr>
    @endforeach
  </table>
@endsection
