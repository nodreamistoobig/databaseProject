@extends('layouts.default')

@section('title', 'Добавление в группу')

@section('content')
<div class="content">

	@if (session()->has('message'))
		<div class="alert">{{session()->get('message')}}</div>
	@endif
	
	<div class="title">Добавление в группу ребенка {{$kid->surname}} {{$kid->firstname}} {{$kid->fathername}}</div>
	
	@foreach ($groups as $group)
		@if ($kid->group != $group)
			<div class="list">
				<div><a href="/groups/{{$group->id}}">{{$group->name}} {{$group->department->name}}</a></div>
				<div>{{$group->educator->surname}} {{$group->educator->firstname}} {{$group->educator->fathername}}</div>
				<div>
					<button onclick="window.location.href = '/clients/kids/{{$kid->id}}/group_add/{{$group->id}}';">Записать</button>
				</div>
			</div>
		@endif
	@endforeach
	{{$groups->links()}}

</div>
@endsection
