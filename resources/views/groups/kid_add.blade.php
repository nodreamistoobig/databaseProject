@extends('layouts.default')

@section('title', 'Добавление в группу')

@section('content')
<div class="content">

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">Добавление в группу {{$group->name}}  {{$group->department->name}} ребенка </div>
	
	@foreach ($kids as $kid)
	@if(!$group->kids->contains($kid))
			<div class="list">
				<div><a href="/clients/kids/{{$kid->id}}">{{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</a> {{$kid->birthday}}</div> 
				<div>
					<button onclick="window.location.href = '/groups/{{$group->id}}/kid_add/{{$kid->id}}';">Записать</button>
				</div>
			</div>
	@endif
	@endforeach
	{{$kids->links()}}

</div>
@endsection
