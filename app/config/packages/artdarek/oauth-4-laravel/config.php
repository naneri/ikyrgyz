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
                    'client_id'     => '355811321290381',
                    'client_secret' => '99047502f07e5427d4145c23893cc733',
                    'scope'         => array('email', 'read_friendlists', 'user_online_presence'),
                ),		

	)

);