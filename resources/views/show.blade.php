@extends('layout')

@section('content')
  <h1>{{ $shop -> name }}</h1>
  <div>
    <p>{{ $shop -> category -> name }}</p>
    <p>{{ $shop -> address }}</p>
  </div>
  <div>
    <a href = '{{ route("shop.edit", ["shop" => $shop->id]) }}', class='btn btn-primary'>編集する</a>
    <a href = '{{ route("shop.list") }}'>一覧にもどる</a>
    {{ Form::open(['method' => 'delete', 'route' => ['shop.destroy', $shop->id] ]) }}
      {{ Form::submit('削除', ['class' => 'btn btn-outline-danger']) }}
    {{ Form::close() }}
  </div>
@endsection