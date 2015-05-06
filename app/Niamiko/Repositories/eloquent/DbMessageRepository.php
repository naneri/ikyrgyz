<?php

namespace Niamiko\Repositories;

use Niamiko\Repositories\MessageRepositoryInterface;

class DbMessageRepository implements MessageRepositoryInterface{

	public function check(){
		echo "<pre>"; print_r('check passed'); echo "</pre>";exit;
	}
}