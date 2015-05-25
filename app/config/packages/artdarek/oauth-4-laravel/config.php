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
                    'scope'         => array('email'),
                ),		

                'Google' => array(
                    'client_id'     => '405435692373-3cqatfkqlpeoapdeu9h0ugspishnofbk.apps.googleusercontent.com',
                    'client_secret' => '4DwvNY7SDXbBJdf8NRt1QzZa',
                    'scope'         => array('userinfo_email', 'userinfo_profile'),
                ),  

                'Vkontakte' => array(
                    'client_id'     => '4906798',
                    'client_secret' => 'mMc59nE1xcP3xlL8KDnJ',
                    'scope'         => array('email'),
                ),  

	)

);