@extends('layouts.default')

@section('title', 'Группы')

@section('content')

<div class="content">
@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Группы
	<button class="button-create" onclick="window.location.href = '/groups/create';">Создать группу</button>
	</div>
	
	@foreach($groups as $group)
	<div class="list">
		<a href="/groups/{{$group->id}}">Группа #{{$group->id}}</a>
		<p>Школа:{{$group->school($schools)}}</p>
		<p>Программа:{{$group->program($programs)}}</p>
		<p>Уровень:{{$group->level}} </p>
		<p>Учитель:{{$group->teacher($teachers)}}</p>		
	</div>
	@endforeach

</div>
@endsection
