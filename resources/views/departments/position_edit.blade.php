@extends('layouts.default')

@section('title', 'Изменение должностной позиции')

@section('content')

<div class="content">

	<div class="title">Изменение должностной позиции {{$position->name}}</div>

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="">
	{{@csrf_field()}}

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название должностной позиции: <input class="@error('name')is-invalid @enderror" name="name" value="@if(empty(old('name'))) {{$position->name}} @else {{old('name')}} @endif">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
