<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<title>I-kyrgyz		</title>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/fonts.css') }}"/>
		<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
		
		<script type="text/javascript" src="{{ asset('js/all.min.js') }}"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		<script src="{{URL::to('js/library/jquery.min.js')}}"></script>	
	</head>
	<body>
		<div class="b-wrapper">
			@include('misc.navbar')
			@yield('content')
		</div>
	 	<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	 	<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
	 	@include('scripts.vote')
	 	@yield('scripts')
	</body>
</html>