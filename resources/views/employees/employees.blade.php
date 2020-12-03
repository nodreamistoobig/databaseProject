@extends('layouts.default')

@section('title', 'Сотрудники')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Все сотрудники
		<button class="button-create" onclick="window.location.href = '/employees/create';">Создать сотрудника</button>
	</div>
	
	
	
	@foreach ($employees as $employee)
	<div class="list-point">
		<a href="/employees/{{$employee->id}}">{{$employee->surname}} {{$employee->firstname}} {{$employee->fathername}}</a>
		<div> <button onclick="window.location.href = '/employees/{{$employee->id}}/archive';">Удалить</button></div>
	</div>
	
	@endforeach
	
</div>
@endsection
