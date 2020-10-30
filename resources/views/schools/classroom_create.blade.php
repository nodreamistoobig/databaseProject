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

	<div class="form-point">
	@error('capasity')
		<div class="alert alert-danger">{{ $message }}</div>
	@enderror
	Вместимость: <input class="@error('capasity')is-invalid @enderror" name="capasity" value="{{old('capasity')}}">
	</div>


	<input type="hidden" name="school_id" value="{{$id}}">


	<button type="submit">Сохранить</button>


	</form>
</div>
@endsection
