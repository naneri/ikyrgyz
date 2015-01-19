<html>
	<head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        
		<?= stylesheet_link_tag() ?>
    	
	</head>
	<body>
		@include('misc.navbar')
		@yield('content')
        @yield('scripts')

     	<?= javascript_include_tag() ?>
     	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	</body>
</html>