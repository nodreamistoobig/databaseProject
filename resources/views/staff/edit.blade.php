@extends('layouts.default')

@section('title', 'Изменение данных')

@section('content')

<div class="content">

	<div class="title">Изменение данных сотрудника: {{$s->last_name}} {{$s->first_name}} {{$s->father_name}}</div>

	@if ($errors->any())
		<div class="alert">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/staff/{{$s->id}}">
	{{@csrf_field()}}

		<div class="form-point">
		@error('last_name')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
		Фамилия: <input class="@error('last_name')is-invalid @enderror" name="last_name" value="@if(empty(old('last_name'))){{$s->last_name}} @else {{old('last_name')}} @endif">
		</div>

		<div class="form-point">
		@error('first_name')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
		Имя: <input class="@error('first_name')is-invalid @enderror" name="first_name" value="@if(empty(old('first_name'))){{$s->first_name}} @else {{old('first_name')}} @endif">
		</div>

		<div class="form-point">
		@error('father_name')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
		Отчество: <input class="@error('father_name')is-invalid @enderror" name="father_name" value="@if(empty(old('father_name'))){{$s->father_name}} @else {{old('father_name')}} @endif">
		</div>

		<div class="form-point">
		@error('birthday')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
		День рождения: <input type="date" class="@error('birthday')is-invalid @enderror" name="birthday" value="@if(empty(old('birthday'))){{$s->birthday}} @else {{old('birthday')}} @endif">
		</div>

		<div class="form-point">
		@error('phone')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
		Телефон: <input class="@error('phone')is-invalid @enderror" name="phone" value="@if(empty(old('phone'))){{$s->phone}} @else {{old('phone')}} @endif">
		</div>

		<div class="form-point">
		@error('status')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
		Статус: 
		<select name="status" class="@error('status')is-invalid @enderror">
			<option value="">-- статус не выбран --</option>
			<option value="Учитель" @if(old('status')=="Учитель" or $s->status == "Учитель") selected @endif>Учитель</option>
			<option value="Администратор" @if(old('status')=="Администратор" or $s->status == "Администратор") selected @endif>Администратор</option>
		</select>

		</div>

		<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
