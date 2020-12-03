@extends('layouts.default')

@section('title', 'Клиенты')

@section('content')
<div class="content">
<div class="button-right"><button class="button-create" onclick="window.location.href = '/clients/kids';">Дети</button></div>

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">Клиенты</div>
	<button class="button-create" onclick="window.location.href = '/clients/create';">Создать карточку клиента</button>
	
	
	@foreach ($clients as $client)
		<div class="list">
			<div><a href="/clients/{{$client->id}}">{{$client->surname}} {{$client->firstname}} {{$client->fathername}}</a></div>
			<div>{{$client->birthday}}</div>
			<div>{{$client->phone}}</div>
			<div>
				<button onclick="window.location.href = '/clients/{{$client->id}}/edit';">Изменить данные клиента</button>
				<button onclick="window.location.href = '/clients/{{$client->id}}/archive';">Удалить</button>
			</div>
		</div>
	@endforeach
	{{$clients->links()}}

</div>
@endsection
