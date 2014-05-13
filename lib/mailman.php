<?php

require "Services/Mailman.php";

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