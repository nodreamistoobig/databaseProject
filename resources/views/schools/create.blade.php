@extends('layouts.default')

@section('title', 'Создание школы')

@section('content')

<div class="content">

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/schools">
	{{@csrf_field()}}

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название школы: <input class="@error('name')is-invalid @enderror" name="name" value="{{old('name')}}">
	</div>

	<div class="form-point">
	@error('address')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Адрес: <input class="@error('address')is-invalid @enderror" name="address" value="{{old('address')}}">
	</div>

	<div class="form-point">
	@error('phone')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Телефон: <input class="@error('phone')is-invalid @enderror" name="phone" value="{{old('phone')}}">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
