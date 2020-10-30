@extends('layouts.default')

@section('title', 'Изменение программы')

@section('content')

<div class="content">

	@if ($errors->any())
		<div class="alert">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<div class="title">Изменение названия программы {{$program->name}}</div>

	<form method="POST" action="/programs/{{$program->id}}">
	{{@csrf_field()}}

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название программы: <input class="@error('name')is-invalid @enderror" name="name" value="@if(empty(old('name'))) {{$program->name}} @else {{old('name')}} @endif">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection