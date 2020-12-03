@extends('layouts.default')

@section('title', 'Клиент')

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

	<form method="POST" action="">
	{{@csrf_field()}}

	<div class="form-point">
	@error('surname')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Фамилия: <input class="@error('surname')is-invalid @enderror" name="surname" value="{{old('surname')}}">
	</div>
	
	<div class="form-point">
	@error('firstname')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Имя: <input class="@error('firstname')is-invalid @enderror" name="firstname" value="{{old('firstname')}}">
	</div>
	
	<div class="form-point">
	@error('fathername')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Отчество: <input class="@error('fathername')is-invalid @enderror" name="fathername" value="{{old('fathername')}}">
	</div>
	
	<div class="form-point">
	@error('birthday')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Дата рождения: <input type="date" class="@error('birthday')is-invalid @enderror" name="birthday" value="{{old('birthday')}}">
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
