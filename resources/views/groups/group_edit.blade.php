@extends('layouts.default')

@section('title', 'Изменение группы')

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

	<div class="title">Изменение группы #{{$group->id}}</div>

	<form method="POST" action="/groups/{{$group->id}}">
	{{@csrf_field()}}

	<div class="form-point">
	@error('school')
		<div class="alert">{{ $message }}</div>
	@enderror
	Школа: 
	<select name="school">
		<option value="">-- школа не выбрана --</option>
		@foreach ($schools as $school)
		<option value="{{$school->id}}" @if(old('school')==$school->id or $group->school_id == $school->id) selected @endif>{{$school->name}}</option>
		@endforeach
	</select>
	</div>

	<div class="form-point">
	@error('program')
		<div class="alert">{{ $message }}</div>
	@enderror
	Программа: 
	<select name="program">
		<option value="">-- программа не выбрана --</option>
		@foreach ($programs as $program)
		<option value="{{$program->id}}" @if(old('program')==$program->id or $group->program_id == $program->id) selected @endif>{{$program->name}}</option>
		@endforeach
	</select>
	</div>

	<div class="form-point">
	@error('level')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Уровень: <input class="@error('level')is-invalid @enderror" name="level" value="@if (empty(old('level'))) {{$group->level}} @else{{old('level')}} @endif">
	</div>

	<div class="form-point">
	@error('teacher')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Учитель: 
	<select name="teacher">
		<option value="">-- учитель не выбран --</option>
		@foreach ($teachers as $teacher)
		<option value="{{$teacher->id}}" @if(old('teacher')==$teacher->id or $group->teacher_id == $teacher->id) selected @endif>{{$teacher->last_name}}</option>
		@endforeach
	</select>
	</div>


	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection