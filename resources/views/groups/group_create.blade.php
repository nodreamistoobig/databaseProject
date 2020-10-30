@extends('layouts.default')

@section('title', 'Создание группы')

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

	<form method="POST" action="/groups">
	{{@csrf_field()}}

	<div class="form-point">
	@error('school')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Школа: 
	<select name="school">
		<option value="">-- школа не выбрана --</option>
		@foreach ($schools as $school)
		<option value="{{$school->id}}">{{$school->name}}</option>
		@endforeach
	</select>
	</div>

	<div class="form-point">
	@error('program')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Программа: 
	<select name="program">
		<option value="">-- программа не выбрана --</option>
		@foreach ($programs as $program)
		<option value="{{$program->id}}">{{$program->name}}</option>
		@endforeach
	</select>
	</div>

	<div class="form-point">
	@error('level')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Уровень: <input class="@error('level')is-invalid @enderror" name="level" value="{{old('level')}}">
	</div>

	<div class="form-point">
	@error('teacher')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Учитель: 
	<select name="teacher">
		<option value="">-- учитель не выбран --</option>
		@foreach ($teachers as $teacher)
		<option value="{{$teacher->id}}">{{$teacher->last_name}}</option>
		@endforeach
	</select>
	</div>


	<button type="submit">Сохранить</button>
</div>

</form>
@endsection

@section('right-menu')
<p>Filters</p>
@endsection