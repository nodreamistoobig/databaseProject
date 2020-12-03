@extends('layouts.default')

@section('title', 'Кабинет')

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

	<form method="POST" action="">
	{{@csrf_field()}}

	<div class="form-point">
	@error('name')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Название кабинета: <input class="@error('name')is-invalid @enderror" name="name" value="{{old('name')}}">
	</div>

	<input type="hidden" name="room_id" value="{{$id}}">


	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
