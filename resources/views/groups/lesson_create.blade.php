@extends('layouts.default')

@section('title', 'Создание урока')

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
	
	<div class="title">
		Создание урока для группы {{$group->id}}
	</div>

	<form method="POST" action="">
	{{@csrf_field()}}

	<div class="form-point">
	@error('day_of_week')
		<div class="alert">{{ $message }}</div>
	@enderror
	Номер дня недели: <input class="@error('day_of_week')is-invalid @enderror" name="day_of_week" value="{{old('day_of_week')}}">
	</div>
	
	<div class="form-point">
	@error('s_time')
		<div class="alert">{{ $message }}</div>
	@enderror
	Время начала: <input type="time" class="@error('s_time')is-invalid @enderror" name="s_time" value="{{old('s_time')}}">
	</div>
	
	<div class="form-point">
	@error('e_time')
		<div class="alert">{{ $message }}</div>
	@enderror
	Время окончания: <input type="time" class="@error('e_time')is-invalid @enderror" name="e_time" value="{{old('e_time')}}">
	</div>

	<div class="form-point">
	@error('classroom')
		<div class="alert">{{ $message }}</div>
	@enderror
	Кабинет: 
	<select name="classroom">
		<option value="">-- кабинет не выбран --</option>
		@foreach ($classrooms as $classroom)
		<option value="{{$classroom->id}}" @if(old('classroom')==$classroom->id) selected @endif>{{$classroom->name}}</option>
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