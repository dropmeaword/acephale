<?php

class LogoutHandler {

	private function __do_logout() {
		session_start();
		session_unset();
		session_destroy();
		ToroHandler::redir("/acephale/");
	}

	public function get() {
		$this->__do_logout();
	}

	public function post() {
		$this->__do_logout();
	}
}
?>