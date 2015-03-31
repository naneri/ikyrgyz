<?php

namespace Niamiko\Repositories\Eloquent;

use Niamiko\Repositories\BlogRepositoryInterface;

class DbBlogRepository implements BlogRepositoryInterface{

	public function check(){
		echo "<pre>"; print_r('check passed'); echo "</pre>";exit;
	}
}