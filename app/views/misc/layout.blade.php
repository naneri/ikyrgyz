<html>
	<head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="{{URL::to('css/style.css')}}">
        <script src="{{URL::to('js/library/jquery.min.js')}}"></script>	
	</head>
	<body>
		<div class="b-wrapper">
			@include('misc.navbar')
			@yield('content')
		</div>
     	<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
     	@include('scripts.vote')
     	@yield('scripts')
		<script src="{{URL::to('js/script.js')}}"></script>
		<script src="{{URL::to('js/dropit.js')}}"></script>
		<script src="{{URL::to('js/npm.js')}}"></script>
	</body>
</html>