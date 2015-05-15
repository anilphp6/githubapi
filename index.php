<?php
/**
 * main files that will execute by command Commands
 */
error_reporting(E_ALL & ~E_NOTICE);
#phpinfo();exit;
#common class need to incude on all pages
require_once 'PostRequest.php';
require_once 'Commands.php';
require_once 'common.php';
require_once 'bitb.php';
require_once 'github.php';
require_once 'ErrorMessage.php';

	$credentials = array(
			'username' 		=> $argv[2],
			'password' 		=> $argv[4],
			'url' 			=> $argv[5],
			'contributorName' 	=> $argv[6],
			'comments' 		=> $argv[7]
		);
		
		/*$credentials = array(
			'username' 		=>'anilphp6',
			'password' 		=> '****',
			'url' 			=> 'https://github.com/anilphp6/testcode',
			'contributorName' 	=> 'anilphp',
			'comments' 		=> 'c'
		);*/
		$cmd_factory 	= new ClassFactory();
		$cmd_factory->StoreInstance($credentials);
		$response 		= $cmd_factory->service_instance()->getCommitCount();
		#$response = null;
		try{	
			if ( $response != NULL && count($response) > 0) {
				foreach ($response as $user_name => $total_count) {
					echo "Contributor Name: " . $user_name;
					echo ": ".$total_count . PHP_EOL;
				}
			}else{
				throw new customException();
			}
	}		
	catch (customException $e) {	
		echo ErrorMessage::RECORD_NOT_FOUND;
	}	

	