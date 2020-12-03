@extends('layouts.default')

@section('title', 'Дети')

@section('content')
<div class="content">
	<div class="button-right"><button class="button-create" onclick="window.location.href = '/clients';">Клиенты</button></div>

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">Дети</div>
	<button class="button-create" onclick="window.location.href = '/clients/kids/create';">Создать карточку ребенка</button>
	
	@foreach ($kids as $kid)
		<div class="list">
			<div><a href="/clients/kids/{{$kid->id}}">{{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</a></div>
			<div>{{$kid->birthday}}</div>
			@if ($kid->phone)
				<div>{{$kid->phone}}</div>
			@endif
			<div>
				<button onclick="window.location.href = '/clients/kids/{{$kid->id}}/edit';">Изменить данные клиента</button>
				<button onclick="window.location.href = '/clients/kids/{{$kid->id}}/archive';">Удалить</button>
			</div>
		</div>
	@endforeach
	{{$kids->links()}}

	
</div>
@endsection
