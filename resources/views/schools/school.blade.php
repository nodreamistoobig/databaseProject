@extends('layouts.default')

@section('title', 'Школа')

@section('content')
<div class="content">
	<div class="button-create">
		<button  onclick="window.location.href = '/schools/{{$school->id}}/edit';">Изменить школу</button>
		<button  onclick="window.location.href = '/schools/{{$school->id}}/classroom_create';">Создать кабинет</button>
	</div>

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">
		Школа #{{$school->id}}
	</div>

	<div class="list-point">
	Название:
	{{$school->name}}
	</div>

	<div class="list-point">
	Адрес:
	{{$school->address}}
	</div>

	<div class="list-point">
	Телефон:
	{{$school->phone}}
	</div>

	<div class="list">
	Кабинеты:
	@foreach ($classrooms as $classroom)
		<div>
			{{$classroom->name}} ({{$classroom->capasity}})
			<button onclick="window.location.href = '/schools/{{$school->id}}/classroom_edit/{{$classroom->id}}';">Изменить кабинет</button>
		</div>
	@endforeach
	</div>
</div>

	@endsection

	

