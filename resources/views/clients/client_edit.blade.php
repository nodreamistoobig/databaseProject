@extends('layouts.default')

@section('title', 'Изменение данных клиента')

@section('content')

<div class="content">

	<div class="title">Изменение данных клиента {{$client->surname}} {{$client->firstname}} {{$client->fathername}}</div>

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/clients/{{$client->id}}/edit">
	{{@csrf_field()}}

	<div class="form-point">
	@error('surname')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Фамилия: <input class="@error('surname')is-invalid @enderror" name="surname" value="@if(empty(old('surname'))) {{$client->surname}}@endif">
	</div>
	
	<div class="form-point">
	@error('firstname')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Имя: <input class="@error('firstname')is-invalid @enderror" name="firstname" value="@if(empty(old('firstname'))) {{$client->firstname}}@endif">
	</div>
	
	<div class="form-point">
	@error('fathername')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Отчество: <input class="@error('fathername')is-invalid @enderror" name="fathername" value="@if(empty(old('fathername'))) {{$client->fathername}}@endif">
	</div>
	
	<div class="form-point">
	@error('birthday')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Дата рождения: <input class="@error('birthday')is-invalid @enderror" name="birthday" value="@if(empty(old('birthday'))) {{$client->birthday}}@endif">
	</div>
	
	<div class="form-point">
	@error('phone')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Телефон: <input class="@error('phone')is-invalid @enderror" name="phone" value="@if(empty(old('phone'))) {{$client->phone}}@endif">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
