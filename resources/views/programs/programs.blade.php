@extends('layouts.default')

@section('title', 'Программы')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Все программы
		<button class="button-create" onclick="window.location.href = '/programs/create';">Создать программу</button>
	</div>
	@foreach ($programs as $program)
	<div class="list-point"><a href="/programs/{{$program->id}}">{{$program->name}}</a></div>
	@endforeach
	
</div>
@endsection

