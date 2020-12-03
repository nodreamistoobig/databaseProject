@extends('layouts.default')

@section('title', 'Группы')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Все группы
		<button class="button-create" onclick="window.location.href = '/groups/create';">Создать группу</button>
	</div>
	
	
	
	@foreach ($groups as $group)
	<div class="list-point">
		<a href="/groups/{{$group->id}}">{{$group->name}} {{$group->department->name}}</a> 
			<p style="font-size: 10px">{{$group->educator->surname}}</p>
		<div> <button onclick="window.location.href = '/groups/{{$group->id}}/archive';">Удалить</button></div>
	</div>
	
	@endforeach
	
</div>
@endsection
