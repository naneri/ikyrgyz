<html>
	<head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        
		<?= stylesheet_link_tag() ?>
    	
	</head>
	<body>
		<div class="b-wrapper">
			@include('misc.navbar')
			@yield('content')
		</div>
     	<?= javascript_include_tag() ?>
     	<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
     	@yield('scripts')
	</body>
</html>