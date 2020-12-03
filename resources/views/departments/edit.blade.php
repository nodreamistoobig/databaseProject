@extends('layouts.default')

@section('title', 'Изменение отдела')

@section('content')

<div class="content">

	<div class="title">Изменение отдела {{$department->name}}</div>

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/departments/{{$department->id}}">
	{{@csrf_field()}}

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название отдела: <input class="@error('name')is-invalid @enderror" name="name" value="@if(empty(old('name'))) {{$department->name}}@endif">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
