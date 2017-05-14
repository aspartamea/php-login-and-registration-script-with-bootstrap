<?php 
	include_once'config/Session.php';

	//Unset all of the session vars
	$_SESSION = array(); 

	//This will kill the session & destroy any cookies
	if (ini_get("session.use_cookies")){
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() -42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
		);
	}

	//Finally destroy the session
	session_destroy();

	header('location: index.php');

?>