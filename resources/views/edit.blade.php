@extends('layout')

@section('content')
  <h1>{{ $shop->name }} を更新</h1>

  {{ Form::model($shop, ['method' => 'put', 'route' => ['shop.update', $shop->id]] ) }}
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
      {{ Form::submit('更新', ['class' => 'btn btn-outline-primary']) }}
    </div>
  {{ Form::close() }}

  <div>
    <a href='{{ route("shop.list") }}'>一覧に戻る</a>
  </div>
@endsection