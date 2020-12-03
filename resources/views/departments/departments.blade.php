@extends('layouts.default')

@section('title', 'Отделы')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Все отделы
		<button class="button-create" onclick="window.location.href = '/departments/create';">Создать отдел</button>
	</div>
	
	
	
	@foreach ($departments as $department)
	<div class="list-point">
		<a href="/departments/{{$department->id}}">{{$department->name}}</a>
		<div> <button onclick="window.location.href = '/departments/{{$department->id}}/archive';">Удалить</button></div>
	</div>
	
	@endforeach
	
</div>
@endsection
