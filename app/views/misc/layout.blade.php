<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title>{{Config::get('app.network_name')}}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('jquery/jquery-ui.js') }}">		</script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    
  </head>
  <body>
    <div class="b-wrapper">
      <div class="b-page">
      	@include('misc.navbar')
		    @yield('content')
      </div>
    </div>
    @include('scripts.vote')
 	@yield('scripts')

    
  </body>
</html>