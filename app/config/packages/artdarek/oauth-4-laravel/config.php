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
                    'client_id'     => '323224569761-es6r8nq3lnj0ul1a0d0jclgio9ceaahl.apps.googleusercontent.com',
                    'client_secret' => '6OhoX4qFAWwDa3aaFIShyQZU',
                    'scope'         => array('userinfo_email', 'userinfo_profile'),
                ),  

                'Vkontakte' => array(
                    'client_id'     => '4906798',
                    'client_secret' => 'mMc59nE1xcP3xlL8KDnJ',
                    'scope'         => array('email'),
                ),  

	)

);