<?php

class UnsubscribeHandler {
	public function get() {
		error_log("UnsubscribeHanldder::get");
		/// first GET request
		if( isset($_GET['address']) && filter_var($_GET['address'], FILTER_VALIDATE_EMAIL)):
			view_render("unsubscribe_confirm", array('title' => _("Confirm unsubscription")) );
		else:
			view_render("unsubscribe_fail", array('title' => _("Confirm unsubscription")) );
		endif;
	}

	public function post() {
		error_log("UnsubscribeHanldder::post");
		/// request to unsubscribe was confirmed through form
		if( isset($_POST['unsubscribe_confirmed']) && isset($_POST['address']) ):
			mm_unsubscribe( $_POST['address'] );
			view_render("unsubscribe_success", array('title' => _("You are unsubscribed")) );
		endif;
	}
}