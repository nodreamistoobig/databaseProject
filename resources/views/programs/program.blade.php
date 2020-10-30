@extends('layouts.default')

@section('title', 'Программа')

@section('content')
<div class="content">
<div class="title">
	Программа {{$program->name}}
	<button class="button-create" onclick="window.location.href = '/programs/{{$program->id}}/edit';">Изменить программу</button>
</div>
<div class="list-point">Название:{{$program->name}}</div>
	
</div>
@endsection
