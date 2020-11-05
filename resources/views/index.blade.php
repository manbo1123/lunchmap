@extends('layout')

@section('content')
  <div class="d-flex justify-content-between">
    <h1>お店一覧</h1>
    @auth   <!-- ログイン時のみ登録ボタンを表示 -->
      <div>
        <a href='{{ route("shop.new") }}', class="btn btn-outline-primary">お店を登録</a>
      </div>
    @endauth
  </div>

  <table class='table table-striped table-hover'>
    <tr>
      <th>カテゴリー</th>
      <th>店名</th>
      <th>住所</th>
      <th>投稿者</th>
    </tr>
    
    @foreach ($shops as $shop)
      <tr>
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
