@extends('layouts.default')

@section('title', 'Изменение школы')

@section('content')

<div class="content">

	<div class="title">Изменение школы {{$school->name}}</div>

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/schools/{{$school->id}}">
	{{@csrf_field()}}

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название школы: <input class="@error('name')is-invalid @enderror" name="name" value="@if(empty(old('name'))) {{$school->name}}@endif">
	</div>

	<div class="form-point">
	@error('address')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Адрес: <input class="@error('address')is-invalid @enderror" name="address" value="@if(empty(old('address'))) {{$school->address}}@endif">
	</div>

	<div class="form-point">
	@error('phone')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Телефон: <input class="@error('phone')is-invalid @enderror" name="phone" value="@if(empty(old('phone'))) {{$school->phone}}@endif">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
