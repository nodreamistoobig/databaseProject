@extends('layouts.default')

@section('title', 'Добавление ребенка')

@section('content')
<div class="content">

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">Добавление ребенка клиенту {{$client->surname}} {{$client->firstname}} {{$client->fathername}}</div>
	
	@foreach ($kids as $kid)
		@if (!$client->kids->contains($kid))
			<div class="list">
				<div><a href="/clients/kids/{{$kid->id}}">{{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</a></div>
				<div>{{$kid->birthday}}</div>
				<div>{{$kid->phone}}</div>
				<div>
					<button onclick="window.location.href = '/clients/{{$client->id}}/kid_add_existed/{{$kid->id}}';">Назначить</button>
				</div>
			</div>
		@endif
	@endforeach
	{{$kids->links()}}

</div>
@endsection
