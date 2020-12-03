@extends('layouts.default')

@section('title', 'Отдел')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Отдел #{{$department->name}}</div>
		<div class="button-right"><button  class="button-create" onclick="window.location.href = '/departments/{{$department->id}}/edit';">Изменить отдел</button></div>
	
	
	
	<div class="list">
	Должностные позиции:
	<button  class="button-create" onclick="window.location.href = '/departments/{{$department->id}}/position_create';">Создать должностную позицию</button>
	@foreach ($department->positions as $position)
		<div>
			{{$position->name}} 
			<button onclick="window.location.href = '/departments/{{$department->id}}/position_edit/{{$position->id}}';">Изменить должностную позицию</button>
			<button onclick="window.location.href = '/departments/{{$department->id}}/position_archive/{{$position->id}}';">Удалить</button>
		</div>
	@endforeach
	</div>
	
	<div class="list">
	Кабинеты:
	<button  class="button-create" onclick="window.location.href = '/departments/{{$department->id}}/room_create';">Создать кабинет</button>
	@foreach ($department->rooms as $room)
		<div>
			{{$room->name}} 
			<button onclick="window.location.href = '/departments/{{$department->id}}/room_edit/{{$room->id}}';">Изменить кабинет</button>
			<button onclick="window.location.href = '/departments/{{$department->id}}/room_archive/{{$room->id}}';">Удалить </button>
		</div>
	@endforeach
	</div>
	
</div>
@endsection
