<div class="container">
	<nav class="navbar navbar-default">
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle='dropdown'>Create <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="{{URL::to('topic/create')}}">Topic</a></li>
					<li><a href="{{URL::to('blog/create')}}">Blog</a></li>
				</ul>
			</li>
			<li><a href="{{URL::to('blog/all')}}">Blogs</a></li>
		</ul>
	</nav>
	
</div>