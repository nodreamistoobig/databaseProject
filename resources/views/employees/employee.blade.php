@extends('layouts.default')

@section('title', 'Сотрудник')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Сотрудник {{$employee->surname}} {{$employee->firstname}} {{$employee->fathername}}</div>
	<div class="button-create">
		<button  onclick="window.location.href = '/employees/{{$employee->id}}/edit';">Изменить данные сотрудника</button>
	</div>

	<div class="list">

		<div >
		Фамилия: {{$employee->surname}}
		</div>
		
		<div >
		Имя: {{$employee->firstname}}
		</div>
		
		<div >
		Отчество: {{$employee->fathername}}
		</div>
		
		<div >
		Дата рождения: {{$employee->birthday}}
		</div>
		
		<div >
		Телефон: {{$employee->phone}}
		</div>
		
		<div >
		Отдел: {{$employee->department->name}}
		</div>
		
		<div >
		Должностная позиция: {{$employee->position->name}}
		</div>

	</div>
</div>
@endsection
