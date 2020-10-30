<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/app.css')}}">
	</head>
	
	<body>
	
		@section('logo')
			<div class="logo">Logo</div>
		@show
		
		@section('main-menu')
		<div class="menu">
			<div class="menu-point"><a href="/groups">Группы</a></div>
			<div class="menu-point"><a href="/staff">Сотрудники</a></div>
			<div class="menu-point"><a href="/schools">Школы</a></div>
			<div class="menu-point"><a href="/programs">Программы</a></div>
		</div>
		@show
		
		@yield('content')
		
		
	</body>
</html>