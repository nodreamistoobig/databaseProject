@extends('layouts.default')

@section('title', 'Ребенок')

@section('content')

<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Ребенок {{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</div>
	<button class="button-create" onclick="window.location.href = '/clients/kids/{{$kid->id}}/edit';">Изменить данные ребенка</button>

	

<div class="list">

	<div >
	Фамилия: {{$kid->surname}}
	</div>
	
	<div >
	Имя: {{$kid->firstname}}
	</div>
	
	<div >
	Отчество: {{$kid->fathername}}
	</div>
	
	<div >
	Дата рождения: {{$kid->birthday}}
	</div>
	
	<div >
	Телефон: {{$kid->phone}}
	</div>

</div>

<div class="list">
	<div class = "title">Родители</div>
	<button  class="button-create" onclick="window.location.href = '/clients/kids/{{$kid->id}}/parent_add';">Создать родителя</button>
	<button  class="button-create" onclick="window.location.href = '/clients/kids/{{$kid->id}}/parent_add_existed'">Добавить родителя</button>
	@foreach($kid->parents as $parent)
		<div>
			<a href="/clients/{{$parent->id}}">{{$parent->surname}} {{$parent->firstname}} {{$parent->fathername}}</a> {{$parent->phone}}
			<button onclick="window.location.href = '/clients/kids/{{$kid->id}}/parent_detach/{{$parent->id}}/';">Удалить</button>
		</div>
	@endforeach
</div>

<div class="list">
	<div class = "title">Группа</div>
	@if ($kid->group)
	<button  class="button-create" onclick="window.location.href = '/clients/kids/{{$kid->id}}/group_add'">Записать в другую группу</button>
		<div>
			<a href="/groups/{{$kid->group->id}}">{{$kid->group->name}} - {{$kid->group->department->name}}</a> 
			<button onclick="window.location.href = '/clients/kids/{{$kid->id}}/group_delete/{{$kid->group->id}}/';">Удалить из группы</button>
		</div>
	@else
		<button  class="button-create" onclick="window.location.href = '/clients/kids/{{$kid->id}}/group_add'">Добавить в группу</button>
	@endif
</div>


@endsection
