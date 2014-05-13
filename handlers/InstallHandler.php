<?php

class InstallHandler {

	public function connect() {
		global $config;
		$db = null;
		//error_log("InstallHandler::__construct - ".$config['db']['filename']);
		//sqlite_open($config['db']['filename']);
		try {
			$db = new PDO("sqlite:".$config['db']['filename']);
		} catch(PDOException $ex) {
			error_log("Failed to open database file ".$config['db']['filename']." - ".$ex->getMessage() );
		} // try..catch
		return $db;
	}

	public static function check_preconditions() {
		global $config;
		$dir = getcwd(); //dirname($config['db']['filename']);
		if (!is_writable(getcwd()) ) {
			return "Installation directory $dir isn't writable. Install will fail.";
		}
	}

	public function get() {
		view_render("install", array('title' => _("Install acephale")) );
	}

	public function createDb() {
		// create database tables
		$sql = "
		CREATE TABLE users (username STRING, email STRING, password STRING, is_admin INTEGER, tstamp_last_login STRING, ip_last_login STRING);
		CREATE TABLE tokens (username STRING, token STRING, is_redeemed INTEGER);
		";

		$db = $this->connect();
		$db->exec($sql);
	}

	public function post() {
		global $config;

		// input validation
		$validates = true;
		if( isset($_POST['admin_password']) && 
			($_POST['admin_password'] != $_POST['admin_password_verify']) ) {
			error_log("password doesn't verify");
			$validates = false;
			Flash::warning("Your password control doesn't match. Try again.");
			ToroHandler::redir("/acephale/install");
		}

		if( strlen($_POST['admin_password']) < 6) {
			Flash::notice("Please fill in a decent password (6 characters at least)");
			$validates = false;
			ToroHandler::redir("/acephale/install");
		}

		if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $_POST['admin_email'])) {
			Flash::notice("Please provide a valid email address");
			ToroHandler::redir("/acephale/install");
		}

		if( isset($_POST['admin_username']) && $validates ) {

			// sanitize input for query
			$username = $_POST['admin_username'];
			$password = $_POST['admin_password'];
			$email = $_POST['admin_email'];
			$password = sha1($password);

			$this->createDb();

			// create admin user
			$db = $this->connect();
			$param = array($username, $email, $password, 1);
			$st = $db->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)");
			$st->execute($param);

			// redirect to main
			ToroHandler::redir("/acephale/");
		}
	} // post
}
?>