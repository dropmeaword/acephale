<?php

class AuthenticatedHandler {
	public static function ensure_admin() {
		if(!session_id()) session_start();
		if( isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1 ) return;
		error_log("User not logged in, redirecting to login page...");
		ToroHandler::redir("/acephale");
	}
}

class ManagementHandler extends AuthenticatedHandler {
	public function get() {
		parent::ensure_admin();
		view_render("admin_menu", array('title' => _("Manage acephale")) );
	}

	public function post() {
	}
}
?>