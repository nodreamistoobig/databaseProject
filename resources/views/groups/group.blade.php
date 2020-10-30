@extends('layouts.default')

@section('title', 'Группа')

@section('content')

<div class="content">

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">Группа #{{$group->id}}
		<div class="button-create" >
			<button onclick="window.location.href = '/groups/{{$group->id}}/edit';">Изменить группу</button>
			<button  onclick="window.location.href = '/groups/{{$group->id}}/lessons';">Добавить урок в расписание</button>
		</div>
	</div>

	<div>
		<p class="list-point">Школа:{{$school->name}}</p>
		<p class="list-point">Программа:{{$program->name}}</p>
		<p class="list-point">Уровень:{{$group->level}} </p>
		<p class="list-point">Учитель:{{$teacher->last_name}} {{$teacher->first_name}}</p>
	</div>
	
	<div class="list">
	<div class="title">Расписание</div>
		@foreach($group->find($group->id)->schedule as $lesson)
			<div>День недели: {{$lesson->day_of_week}}</div>
			<div>Время: {{$lesson->start_time}} - {{$lesson->end_time}}</div>
			<div>Кабинет: {{$lesson->classroom_id}}</div><br>
			<button  onclick="window.location.href = '/groups/{{$group->id}}/lesson_delete/{{$lesson->id}}';">Удалить урок</button>
		@endforeach
	</div>
	
	
	

</div>
@endsection
