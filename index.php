<?php
require_once "config.php";
require_once "vendor/autoload.php";

require_once "handlers/MainHandler.php";
require_once "handlers/InstallHandler.php";
require_once "handlers/ManageHandler.php";
require_once "handlers/UnsubscribeHandler.php";
require_once "handlers/LogoutHandler.php";

require_once "lib/Toro.php";
require_once "lib/common.php";
require_once "lib/flash.php";

require_once "lib/mailman.php";


ToroWorkaround::serve(array(
    "/" => "MainHandler",
    "/manage" => "ManagementHandler",
    "/manage/add" => "ManagementHandler",
    "/manage/remove" => "ManagementHandler",
    "/manage/search" => "ManagementHandler",
    "/manage/export" => "ManagementHandler",
    "/install" => "InstallHandler",
    "/unsubscribe" => "UnsubscribeHandler",
    "/logout" => "LogoutHandler"
));

?>