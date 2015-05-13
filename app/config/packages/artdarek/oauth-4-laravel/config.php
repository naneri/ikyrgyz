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
                    'client_id'     => '895920337159636',
                    'client_secret' => '7a28056c7fc09044997e81207aff49c1',
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