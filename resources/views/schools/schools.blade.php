@extends('layouts.default')

@section('title', 'Школы')

@section('content')
<div class="content">

@if (session()->has('message'))
	<div class="alert">{{session()->get('message')}}</div>
@endif

	<div class="title">Все школы
		<button class="button-create" onclick="window.location.href = '/schools/create';">Создать школу</button>
	</div>
	
	
	
	@foreach ($schools as $school)
	<div class="list-point"><a href="/schools/{{$school->id}}">{{$school->name}}</a></div>
	@endforeach
	
</div>
@endsection
