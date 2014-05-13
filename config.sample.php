<?php

$incpath = '/path/to/pear/PEAR';
set_include_path(get_include_path() . PATH_SEPARATOR . $incpath);


$config['db']['filename'] = "acephale.db";

$config['mailman']['list'] = 'newsletter name';
$config['mailman']['admin_url'] = 'http://<mailman admin url>';
$config['mailman']['admin_username'] = "<mailman admin username>";
$config['mailman']['admin_password'] = '<mailman user password>';

$config['template']['root'] = "views/";


?>
