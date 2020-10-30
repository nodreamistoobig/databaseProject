@extends('layouts.default')

@section('title', 'Сотрудник')

@section('content')

<div class="content">

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif

	<div class="title">Сотрудник: {{$s->last_name}} {{$s->first_name}} {{$s->father_name}}
		<button class="button-create" onclick="window.location.href = '/staff/{{$s->id}}/edit';">Изменить данные</button>
	</div>
	
	


	<div class="list-point">
	Фамилия: {{$s->last_name}}
	</div>

	<div class="list-point">
	Имя: {{$s->first_name}}
	</div>

	<div class="list-point">
	Отчество: {{$s->father_name}}
	</div>

	<div class="list-point">
	Дата рождения: {{$s->birthday}}
	</div>

	<div class="list-point">
	Телефон: {{$s->phone}}
	</div>

	<div class="list-point">
	Статус: {{$s->status}}
	</div>

</div>
@endsection


