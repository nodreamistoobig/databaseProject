@extends('layouts.default')

@section('title', 'Создание отдела')

@section('content')

<div class="content">

	@if ($errors->any())
		<div class="alert alert-danger">
			@if(!empty($errors))
				Обратите внимание на ошибки!
			@endif
			</ul>
		</div>
	@endif

	<form method="POST" action="/departments">
	{{@csrf_field()}}

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название отдела: <input class="@error('name')is-invalid @enderror" name="name" value="{{old('name')}}">
	</div>

	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
