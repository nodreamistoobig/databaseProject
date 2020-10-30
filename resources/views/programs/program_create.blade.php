@extends('layouts.default')

@section('title', 'Programs')

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

	<form method="POST" action="/programs">
	{{@csrf_field()}}

	<div class="list-point">
	@error('name')
		<div class="alert">{{ $message }}</div>
	@enderror
	Название программы: <input class="@error('name')is-invalid @enderror" name="name" value="{{old('name')}}">
	</div>

	<button type="submit">Сохранить</button>

	</form>
</div>
@endsection