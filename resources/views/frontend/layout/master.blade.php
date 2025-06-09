<!DOCTYPE html>
<html>
<head>
	<base href="{{ url('/') }}">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="">
	<meta name="_token" content="{{ csrf_token() }}">
	<title>Yantra</title>
</head>
<body>
    <div>
	@section('header')
	<header>Header</header>
	@show

	<div class="">
		@yield('contant')
	</div>

	@section('footer')
	<footer>Footer</footer>
	@show
	</div>
</body>
</html>
