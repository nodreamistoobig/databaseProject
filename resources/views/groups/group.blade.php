@extends('layouts.default')

@section('title', 'Группа')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Группа {{$group->name}} {{$group->department->name}}</div>
		<button class="button-create" onclick="window.location.href = '/groups/{{$group->id}}/edit';">Изменить группу</button>

	<div class="list">

		<div >
		Название: {{$group->name}}
		</div>
		
		<div >
		Отдел: {{$group->department->name}}
		</div>
		
		<div >
		Кабинет: {{$group->room->name}}
		</div>
		
		<div >
		Воспитатель: {{$group->educator->surname}} {{$group->educator->firstname}} {{$group->educator->fathername}}
		</div>
		
		<div >
		Ответственный : {{$group->manager->surname}} {{$group->manager->firstname}} {{$group->manager->fathername}} 
		</div>

	</div>
	
	<div class="list">
	<div class = "title">Дети в группе</div>
	<button  class="button-create" onclick="window.location.href = '/groups/{{$group->id}}/kid_add'">Добавить ребенка в группу</button>
	@foreach($group->kids as $kid)
		<div>
			<a href="/clients/kids/{{$kid->id}}">{{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</a> {{$kid->birthday}}
			<button onclick="window.location.href = '/groups/{{$group->id}}/kid_delete/{{$kid->id}}/';">Удалить</button>
		</div>
	@endforeach
</div>
	
</div>
@endsection


