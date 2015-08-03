<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv='Content-Type' in your page content='text/html; charset=UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{Config::get('app.network_name')}}</title>
    <link rel="shortcut icon" href="{{ URL::to('img/favicon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/party.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/tinymce.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/mediaelementplayer.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/mejs-skins.css') }}"/>
    @yield('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('jquery/jquery-ui.js') }}">		</script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/jquery.formstyler.js') }}"></script>
    {{HTML::style('css/jquery.formstyler.css')}}
    <script src="{{ asset('js/jquery.easytabs.js') }}"></script>
    <script src="{{asset('js/tooltip.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplemodal/1.4.4/jquery.simplemodal.min.js"></script>
    <script src="{{ asset('js/mediaelement-and-player.min.js') }}"></script>
    @include('misc.js')
    @include('scripts.convert-times')
  </head>
  <body>
    <div class="b-wrapper">
      <div class="b-page">
       
      	@include("{$template}misc.navbar")
		    @yield('content')
      </div>
    </div>
  @include('scripts.vote')
 	@yield('scripts')

  @if(isset(Config::get('social.yandex-metrika')[Config::get('app.nation_name')]))
    {{Config::get('social.yandex-metrika')[Config::get('app.nation_name')]}}
    
  @endif  
  </body>
</html>