<?php

require "Services/Mailman.php";

function mm_search($query) {
	global $config;

	$results = array();
	$mm = new Services_Mailman($config['mailman']['admin_url'],
								$config['mailman']['list'],
								$config['mailman']['admin_password']);
	try {
		$res = $mm->member( $query );
		#var_dump($res);
		#echo "===========================<br/>";
		foreach($res as $result) {
			array_push($results, $result['address']);
		}
		#var_dump($results);
	} catch (Services_Mailman_Exception $ex) {
		error_log("Search for term $query failed, message was: ".$ex->getMessage() );
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
	return $success;
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
	return $success;
}

function mm_allmembers() {
	global $config;

	$results = array();
	$mm = new Services_Mailman($config['mailman']['admin_url'],
								$config['mailman']['list'],
								$config['mailman']['admin_password']);
	try {
		$res = $mm->members();
		#var_dump($res);
		#echo "===========================<br/>";
		foreach($res as $result) {
			array_push($results, $result['address']);
		}
		#var_dump($results);
	} catch (Services_Mailman_Exception $ex) {
		error_log("Search for term $query failed, message was: ".$ex->getMessage() );
	}

	return $results;
}

?>