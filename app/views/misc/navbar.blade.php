@if(Auth::check())
	
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{URL::to('/')}}">I-Kyrgyz</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="#">first</a></li>
					<li><a href="#">asd</a></li>
					<li class="dropdown">
		                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
		                <ul class="dropdown-menu" role="menu">
		                  <li><a href="{{URL::to('profile/edit')}}">Edit Profile</a></li>
		                  <li><a href="#">aaa</a></li>
		                  <li><a href="#">aaa</a></li>
		                  <li class="divider"></li>
		                  <li class="dropdown-header">Nav header</li>
		                  <li><a href="#">aaa</a></li>
		                  <li><a href="#">aa</a></li>
		                </ul>
		            </li>
		            <li><a href="{{URL::to('people')}}">{{trans('network.search_friends')}}</a></li>
		            <li><a href="{{URL::to('logout')}}">{{trans('network.logout')}}</a></li>
				</ul>
			</div>
		</div>
	</nav>


@endif