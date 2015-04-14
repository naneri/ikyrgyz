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
            'client_id'     => '1047357178613272',
            'client_secret' => 'bf8a170e997961381217ee681b705158',
            'scope'         => array('email'),
        ),

        'Google' => array(
            'client_id'     => 'Your Google client ID',
            'client_secret' => 'Your Google Client Secret',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),

    )

);