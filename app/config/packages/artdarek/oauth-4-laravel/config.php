<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
                'Facebook' => array(
                    'client_id'     => '1608907909354855',
                    'client_secret' => '813687220cb7b5b18cf583b527f66415',
                    'scope'         => array('email', 'read_friendlists', 'user_online_presence'),
                ),		

	)

);