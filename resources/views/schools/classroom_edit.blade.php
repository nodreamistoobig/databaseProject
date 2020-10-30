@extends('layouts.default')

@section('title', 'Изменение кабинета')

@section('content')

<div class="content">

	<div class="title">Изменение кабинета {{$classroom->name}}</div>

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
	Название кабинета: <input class="@error('name')is-invalid @enderror" name="name" value="@if(empty(old('name'))) {{$classroom->name}} @else {{old('name')}} @endif">
	</div>

	<div class="form-point">
	@error('capasity')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Вместимость: <input class="@error('capasity')is-invalid @enderror" name="capasity" value="@if(empty(old('capasity'))) {{$classroom->capasity}} @else {{old('capasity')}} @endif">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
