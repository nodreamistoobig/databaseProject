@extends('layouts.default')

@section('title', 'Клиент')

@section('content')

<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Клиент {{$client->surname}} {{$client->firstname}} {{$client->fathername}}</div>
	<button class="button-create" onclick="window.location.href = '/clients/{{$client->id}}/edit';">Изменить данные</button>

	

<div class="list">

	<div >
	Фамилия: {{$client->surname}}
	</div>
	
	<div >
	Имя: {{$client->firstname}}
	</div>
	
	<div >
	Отчество: {{$client->fathername}}
	</div>
	
	<div >
	Дата рождения: {{$client->birthday}}
	</div>
	
	<div >
	Телефон: {{$client->phone}}
	</div>

</div>

<div class="list">
	<div class = "title">Дети</div>
	<div class="button-right"><button class="button-create" onclick="window.location.href = '/clients/{{$client->id}}/kid_add'">Создать ребенка</button></div>
	<div class="button-right"><button class="button-create" onclick="window.location.href = '/clients/{{$client->id}}/kid_add_existed'">Добавить ребенка</button></div>
	@foreach($client->kids as $kid)
		<div>
			<a href="/clients/kids/{{$kid->id}}">{{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</a> {{$kid->birthday}}
			<button onclick="window.location.href = '/clients/{{$client->id}}/kid_detach/{{$kid->id}}/';">Удалить</button>
		</div>
	@endforeach
</div>
@endsection
