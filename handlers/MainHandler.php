<?php

class MainHandler {
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

	public function get() {
		global $config;
		
		/// check if we are installed
		if( !file_exists($config['db']['filename']) ) {
			ToroHandler::redir("/acephale/install");
		} else {
			view_render('login', array('title' => _("Welcome to acephale")) );
		}
	}

	public function post_login($username) {
		global $config;
		// keep a record of where last user logged from and when that was
		$ip = get_client_ip();

		//error_log("post_login CALLED!");

		$param = array($ip, $username);
		$db = $this->connect();
		$ps = $db->prepare("UPDATE users SET tstamp_last_login=datetime('now', 'localtime'), ip_last_login=? WHERE username=?");
		$ps->execute($param);
	}

	public function do_login($username, $password) {
		// create user database
		$db = $this->connect();
		$ps = $db->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
		$ps->execute( array($username) );
		$res = $ps->fetchAll();

		// check password match
		if( (count($res) > 0) 
			&& ($res[0]['password'] == sha1($password)) ) {
			//error_log("MainHandler::post password matched");
			session_start();
			$_SESSION['username'] = $res[0]['username'];
			$_SESSION['is_admin'] = $res[0]['is_admin'];
			$this->post_login($username);
			//error_log("MainHandler::post redirecting");
			ToroHandler::redir("/acephale/manage");
		} else {
			//error_log("MainHandler::post password DIDN'T match");
			Flash::alert("Couldn't log you in. Please try again.");
			ToroHandler::redir("/acephale/");
		}
	}

	public function post() {
		global $config;

		if($_POST['action'] == 'login') {
			//error_log("MainHandler::post login");
			$username = $_POST['username'];
			$password = $_POST['password'];
			$this->do_login($username, $password);
		}
	} // post
} // class

?>