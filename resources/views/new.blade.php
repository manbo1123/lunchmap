@extends('layout')

@section('content')
  <h1>お店を登録</h1>

  {{ Form::open(['route' => 'shop.store']) }}
    <div class='form-group'>
      {{ Form::label('name', '店名： ') }}
      {{ Form::text('name', null, ['placeholder'=>'店名を入力']) }}
    </div>

    <div class='form-group'>
      {{ Form::label('address', '住所： ') }}
      {{ Form::text('address', null, ['placeholder'=>'住所を入力']) }}
    </div>

    <div class='form-group'>
      {{ Form::label('category_id', 'カテゴリー： ') }}
      {{ Form::select('category_id', $categories) }}
    </div>

    <div class='form-group'>
      {{ Form::submit('登録する', ['class' => 'btn btn-outline-primary']) }}
    </div>
  {{ Form::close() }}

  <div>
    <a href='{{ route("shop.list") }}'>一覧に戻る</a>
  </div>
@endsection