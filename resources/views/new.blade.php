@extends('layout')

@section('content')
  <h1>お店を登録</h1>
  <span>{{\App\Enums\Status::getStatus('0')}}</span>

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

    <div class="d-flex">
      <div class='form-group px-2'>
        {{ Form::submit('登録', ['class' => 'btn btn-primary']) }}
      </div>
      <div class="px-2">
        <a href='{{ route("shop.list") }}' class="btn btn-outline-secondary">一覧にもどる</a>
      </div>
    </div>
  {{ Form::close() }}
@endsection