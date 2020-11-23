@extends('layout')

@section('content')
  <h1>{{ $shop -> name }}</h1>
  <div>
    <p>{{ $shop -> category -> name }}</p>
    <p>{{ $shop -> address }}</p>

    <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key={{ config("services.google-map.apikey") }}&q={{ $shop->address }}'
      width='50%' height='300' frameborder='0'>
    </iframe>
  </div>
  <div class="d-flex">
    @auth   <!-- 投稿者にのみ、編集ボタン、削除ボタンを表示 -->
      @if ($shop -> user_id == $login_user_id)
        <a href = '{{ route("shop.edit", ["shop" => $shop->id]) }}', class='btn btn-primary mx-3'>編集</a>
        {{ Form::open(['method' => 'delete', 'route' => ['shop.destroy', $shop->id] ]) }}
          {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
        {{ Form::close() }}
      @endif
    @endauth
    <a href = '{{ route("shop.list") }}' class="d-flex align-items-center btn btn-outline-secondary mx-3">一覧にもどる</a>
  </div>
@endsection