<?php

require "Services/Mailman.php";

function mm_search($query) {
	global $config;

	$results = array();
	$mm = new Services_Mailman($config['mailman']['admin_url'],
								$config['mailman']['list'],
								$config['mailman']['admin_password']);
	$success = false;
	try {
		$results = $mm->member( $query );
	} catch (Services_Mailman_Exception $ex) {
		error_log("Failed to subscribe user with address $address, message was: ".$ex->getMessage() );
	}

	return $results;
}

function mm_subscribe($address) {
	global $config;

	$mm = new Services_Mailman($config['mailman']['admin_url'],
								$config['mailman']['list'],
								$config['mailman']['admin_password']);
	$success = false;
	try {
		$mm->subscribe( $address );
		$success = true;
	} catch (Services_Mailman_Exception $ex) {
		error_log("Failed to subscribe user with address $address, message was: ".$ex->getMessage() );
		$success = false;
	}
}

function mm_unsubscribe($address) {
	global $config;

	$mm = new Services_Mailman($config['mailman']['admin_url'],
								$config['mailman']['list'],
								$config['mailman']['admin_password']);
	$success = false;
	try {
		$mm->unsubscribe( $address );
		$success = true;
	} catch (Services_Mailman_Exception $ex) {
		error_log("Failed to unsubscribe user with address $address, message was: ".$ex->getMessage() );
		$success = false;
	}
}

?>