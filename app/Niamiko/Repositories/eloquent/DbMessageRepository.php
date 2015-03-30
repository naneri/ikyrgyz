<?php

namespace Niamiko\Repositories\Eloquent;

use Niamiko\Repositories\MessageRepositoryInterface;

class DbMessageRepository implements MessageRepositoryInterface{

	public function check(){
		echo "<pre>"; print_r('check passed'); echo "</pre>";exit;
	}
}