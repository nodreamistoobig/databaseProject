@extends('layouts.default')

@section('title', 'Создание сотрудника')

@section('content')

<div class="content">

	@if ($errors->any())
		<div class="alert">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/staff">
	{{@csrf_field()}}

	<div class="form-point">
	@error('last_name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Фамилия: <input class="@error('last_name')is-invalid @enderror" name="last_name" value="{{old('last_name')}}">
	</div>

	<div class="form-point">
	@error('first_name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Имя: <input class="@error('first_name')is-invalid @enderror" name="first_name" value="{{old('first_name')}}">
	</div>

	<div class="form-point">
	@error('father_name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Отчество: <input class="@error('father_name')is-invalid @enderror" name="father_name" value="{{old('father_name')}}">
	</div>

	<div class="form-point">
	@error('birthday')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	День рождения: <input type="date" class="@error('birthday')is-invalid @enderror" name="birthday" value="{{old('birthday')}}">
	</div>

	<div class="form-point">
	@error('phone')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Телефон: <input class="@error('phone')is-invalid @enderror" name="phone" value="{{old('phone')}}">
	</div>

	<div class="form-point">
	@error('status')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Статус: 
	<select name="status" class="@error('status')is-invalid @enderror">
		<option value="">-- статус не выбран --</option>
		<option value="Учитель" @if(old('status')=="Учитель") selected @endif>Учитель</option>
		<option value="Администратор" @if(old('status')=="Администратор") selected @endif>Администратор</option>
	</select>

	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
