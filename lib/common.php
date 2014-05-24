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

define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);

function sqltime_to_time($sqltime) {
	return date_create_from_format('Y-m-d H:i:s',$sqltime)->getTimestamp();
}

/*
function sqltime_to_time($sqltime) {
	#date_default_timezone_set("GMT+2");
	# split SQL date into date / time
	@list($date , $time) = explode(' ' , $sqltime);
	# split date in Y,m,d
	@list($Y,$m,$d) = explode('-' , $date);
	# check that this is actually a valid date!
	if(@checkdate($m , $d , $Y)){
		# if we have a time, then we can show relative time calcs!
		if(isset($time) && $time){
			@list($H,$i,$s) = explode(':' , $time);
		} else {
			$H=12;
			$i=0;
			$s=0;
		}
		// Set the event timestamp
		echo "$H:$i:$s $d-$m-$Y  ";
		return gmmktime($H, $i , $s , $m , $d , $Y);
	} else {
		return "invalid date";
	}
}
*/

/**
 * Print a read-friendly time string relative to the now.
 * from http://stackoverflow.com/questions/11/how-do-i-calculate-relative-time
 */
function friendly_time($tstamp)
{   
    $delta = time() - $tstamp;

    if ($delta < 1 * MINUTE)
    {
        return $delta == 1 ? "one second ago" : $delta . " seconds ago";
    }
    if ($delta < 2 * MINUTE)
    {
      return "a minute ago";
    }
    if ($delta < 45 * MINUTE)
    {
        return floor($delta / MINUTE) . " minutes ago";
    }
    if ($delta < 90 * MINUTE)
    {
      return "an hour ago";
    }
    if ($delta < 24 * HOUR)
    {
      return floor($delta / HOUR) . " hours ago";
    }
    if ($delta < 48 * HOUR)
    {
      return "yesterday";
    }
    if ($delta < 30 * DAY)
    {
        return floor($delta / DAY) . " days ago";
    }
    if ($delta < 12 * MONTH)
    {
      $months = floor($delta / DAY / 30);
      return $months <= 1 ? "one month ago" : $months . " months ago";
    }
    else
    {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "one year ago" : $years . " years ago";
    }
} // function


?>