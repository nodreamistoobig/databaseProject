@extends('layouts.default')

@section('title', 'Изменение кабинета')

@section('content')

<div class="content">

	<div class="title">Изменение кабинета {{$room->name}}</div>

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
	Название кабинета: <input class="@error('name')is-invalid @enderror" name="name" value="@if(empty(old('name'))) {{$room->name}} @else {{old('name')}} @endif">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
