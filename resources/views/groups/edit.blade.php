@extends('layouts.default')

@section('title', 'Изменение данных сотрудника')

@section('content')

<div class="content">

	<div class="title">Изменение группы {{$group->name}} - {{$group->department->name}}</div>

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/groups/{{$group->id}}">
	{{@csrf_field()}}
	

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название: <input class="@error('name')is-invalid @enderror" name="name" value="@if(empty(old('name'))) {{$group->name}}@endif">
	</div>
	
	<div class="form-point">
	@error('department_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
	@error('room_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
	@error('educator_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
	Кабинет: 
		<select class="@error('room_id')is-invalid @enderror" name="room_id">
			<option value="">-- не выбран --</option>
			@foreach ($departments as $department)
				@foreach ($department->rooms as $room)
					<option value="{{$room->id}}" @if(old('room_id')== $room->id or $group->room->id == $room->id) selected @endif>{{$department->name}} - {{$room->name}}</option>
				@endforeach
			@endforeach
		</select>
	
	Воспитатель: 
		<select class="@error('educator_id')is-invalid @enderror" name="educator_id">
			<option value="">-- не выбран --</option>
			@foreach ($departments as $department)
				@foreach ($department->employees as $employee)
					<option value="{{$employee->id}}" @if(old('educator_id')== $employee->id or $group->educator->id == $employee->id) selected @endif>{{$department->name}} - {{$employee->surname}} {{$employee->firstname}} {{$employee->fathername}}</option>
				@endforeach
			@endforeach
		</select>
				
				
				
			
	</div>
	
	<div class="form-point">
	
	@error('manager_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
	
	Ответственный за группу: 
	<select class="@error('manager_id')is-invalid @enderror" name="manager_id">
		<option value="">-- не выбран --</option>
		@foreach ($employees as $employee)
			<option value="{{$employee->id}}" @if(old('manager_id')== $employee->id or $group->manager->id == $employee->id) selected @endif>{{$employee->surname}} {{$employee->firstname}} {{$employee->fathername}}</option>
		@endforeach
	</select>
	</div>
	
	<button type="submit">Сохранить</button>

	</form>
</div>
@endsection
