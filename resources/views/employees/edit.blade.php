@extends('layouts.default')

@section('title', 'Изменение данных сотрудника')

@section('content')

<div class="content">

	<div class="title">Изменение данных сотрудника {{$employee->surname}} {{$employee->firstname}} {{$employee->fathername}}</div>

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/employees/{{$employee->id}}">
	{{@csrf_field()}}

	<div class="form-point">
	@error('surname')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Фамилия: <input class="@error('surname')is-invalid @enderror" name="surname" value="@if(empty(old('surname'))) {{$employee->surname}}@endif">
	</div>
	
	<div class="form-point">
	@error('firstname')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Имя: <input class="@error('firstname')is-invalid @enderror" name="firstname" value="@if(empty(old('firstname'))) {{$employee->firstname}}@endif">
	</div>
	
	<div class="form-point">
	@error('fathername')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Отчество: <input class="@error('fathername')is-invalid @enderror" name="fathername" value="@if(empty(old('fathername'))) {{$employee->fathername}}@endif">
	</div>
	
	<div class="form-point">
	@error('birthday')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Дата рождения: <input class="@error('birthday')is-invalid @enderror" name="birthday" value="@if(empty(old('birthday'))) {{$employee->birthday}}@endif">
	</div>
	
	<div class="form-point">
	@error('phone')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Телефон: <input class="@error('phone')is-invalid @enderror" name="phone" value="@if(empty(old('phone'))) {{$employee->phone}}@endif">
	</div>
	
	<div class="form-point">
	@error('department_id')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Отдел - Позиция:
		<select name="position_id">
		@foreach ($departments as $department)
			
				@foreach ($department->positions as $position)
					<option value="{{$position->id}}" @if(old('position_id')== $position->id) selected @endif> {{$department->name}} - {{$position->name}} </option>
				@endforeach
			
		@endforeach
		</select>
	
	</div>	

	<button type="submit">Сохранить</button>

	</form>
</div>
@endsection
