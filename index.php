<?php
require_once "config.php";

require_once "handlers/MainHandler.php";
require_once "handlers/InstallHandler.php";
require_once "handlers/ManageHandler.php";
require_once "handlers/UnsubscribeHandler.php";
require_once "handlers/LogoutHandler.php";

require_once "lib/Toro.php";
require_once "lib/common.php";
require_once "lib/flash.php";

require_once "lib/mailman.php";

///require "Services/Mailman.php";


/*
ToroHook::add("404", function() {
    echo "<p style='font-size:40pt;'>404</p><small>nobody's home</small>";
});
*/

//error_log("Fuuuuuck! PATH_INFO = ".$_SERVER['REQUEST_URI']);

ToroWorkaround::serve(array(
    "/" => "MainHandler",
    "/manage" => "ManagementHandler",
    "/install" => "InstallHandler",
    "/unsubscribe" => "UnsubscribeHandler",
    "/logout" => "LogoutHandler"
));


/*
$db = new DB($config['db']['filename']);

$db->exec('CREATE TABLE foo (bar STRING)');
$db->exec("INSERT INTO foo (bar) VALUES ('This is a test')");

$result = $db->query('SELECT bar FROM foo');
var_dump($result->fetchArray());
*/

?>