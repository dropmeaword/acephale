<?php

/**
 * Get mailman list name
 */
function mm_get_list_name() {
	global $config;
	return $config['mailman']['list'];
}

/**
 * Get application's base url.
 */
function get_url() {
	return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

/**
 * Get client's IP address.
 */
function get_client_ip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//check ip from share internet
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//to check ip is pass from proxy
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip=$_SERVER['REMOTE_ADDR'];
	}

    return $ip;
}

/**
 * Render page view with name $name embedded in layout.
 */
function view_render($name, $ctx = array() ) {
	global $config;

	$pagectx = array();
	$pagectx['template'] = $config['template']['root'].$name.".php";
	$pagectx = array_merge($pagectx, $ctx);

	include $config['template']['root']."/layout.php";
}

/**
 * Render partial view with name $name without layout.
 * Used in ajax calls.
 */
function partial_render($name, $ctx = array() ) {
	global $config;

	$pagectx = array();
	$pagectx = array_merge($pagectx, $ctx);

	include $config['template']['root'].$name.".php";
}

?>