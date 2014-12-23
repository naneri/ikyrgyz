<?php

Class Blog extends Eloquent{

	public function topics()
        {
            return $this->hasMany('Topic');
        }
}