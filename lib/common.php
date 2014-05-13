<?php

function mm_get_list_name() {
	global $config;
	return $config['mailman']['list'];
}
function get_url() {
	return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

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

function view_render($name, $ctx = array() ) {
	global $config;

	$pagectx = array();
	$pagectx['template'] = $config['template']['root'].$name.".php";
	$pagectx = array_merge($pagectx, $ctx);

	include $config['template']['root']."/layout.php";
}

?>