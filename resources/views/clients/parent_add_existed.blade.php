@extends('layouts.default')

@section('title', 'Добавление родителя')

@section('content')
<div class="content">

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">Добавление родителя ребенку {{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</div>
	
	@foreach ($clients as $client)
		@if (!$kid->parents->contains($client))
			<div class="list">
				<div><a href="/clients/kids/{{$client->id}}">{{$client->surname}} {{$client->firstname}} {{$client->fathername}}</a></div>
				<div>{{$client->birthday}}</div>
				<div>{{$client->phone}}</div>
				<div>
					<button onclick="window.location.href = '/clients/kids/{{$kid->id}}/parent_add_existed/{{$client->id}}';">Назначить</button>
				</div>
			</div>
		@endif
	@endforeach
	{{$clients->links()}}

</div>
@endsection
