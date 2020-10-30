@extends('layouts.default')

@section('title', 'Сотрудники')

@section('content')
<div class="content">

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif

	<div class="title">Все сотрудники
		<button class="button-create" onclick="window.location.href = '/staff/create';">Создать сотрудника</button>
	</div>
	<div>
		@foreach ($staff as $s)
		<div class="list-point"><a href="/staff/{{$s->id}}">{{$s->last_name}} {{$s->first_name}} {{$s->father_name}} ({{$s->status}})</a></div>
		@endforeach
	</div>
		
</div>
@endsection

