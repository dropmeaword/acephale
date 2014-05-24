<?php

class AuthenticatedHandler {
	public function connect() {
		global $config;
		$db = null;
		// keep a record of where last user logged from and when that was
		try {
			$db = new PDO("sqlite:".$config['db']['filename']);
		} catch(PDOException $ex) {
			error_log("Failed to open database ".$ex->getMessage() );
		} // try..catch

		return $db;
	}

	public function get_user() {
		// create user database
		$username = $_SESSION["username"];
		$db = $this->connect();
		$ps = $db->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
		$ps->execute( array($username) );
		$res = $ps->fetchAll();
		return $res[0];
	}

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
		$usr = $this->get_user();
		view_render("admin_menu", array(
									'title' => _("Manage acephale"),
									'username' => $usr['username'],
									'last_login' => $usr['tstamp_last_login'],
									'last_ip' => $usr['ip_last_login'], 
								)
					);
	}

	private function parse_addresses($text) {
		# @TODO get new line character from PHP environment
		$text = trim($text);
		$inlst = split("\r\n", $text);
		$outlst = array();

		foreach($inlst as $address) {
			# check that we are indeed dealing with a valid email address
			if(preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $address) ) {
				error_log("parsing valid address: $address");
				array_push($outlst, $address);
			} else {
				error_log("parsing invalid: $address");
				Flash::warning($address." is not a valid email address, ignoring.");
			}
		}

		return $outlst;
	}

	public function post() {
		$usr = $this->get_user();

		if( isset($_POST['action']) ) {
			switch($_POST['action']) {
				case 'add':
					$list = $this->parse_addresses($_POST['addresses']);
					foreach($list as $address) {
						error_log("adding: $address");
					}
					break;
				case 'remove':
					$list = $this->parse_addresses($_POST['addresses']);
					foreach($list as $address) {
						error_log("removing: $address");
					}
					break;
				case 'search':
					$query = $_POST['term'];
					error_log("searching for: $query");
					break;
			}

			partial_render("manage_result", array(
										'username' => $usr['username'],
										'last_login' => $usr['tstamp_last_login'],
										'last_ip' => $usr['ip_last_login'], 
									)
						);
		} // if..else
		else {
			ToroHandler::redir("/acephale/manage");
		}
	} // function post
} // class
?>