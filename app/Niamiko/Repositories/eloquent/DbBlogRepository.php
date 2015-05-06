<?php

namespace Niamiko\Repositories;

use Niamiko\Repositories\BlogRepositoryInterface;

class DbBlogRepository implements BlogRepositoryInterface{

	public function check(){
		echo "<pre>"; print_r('check passed'); echo "</pre>";exit;
	}
}