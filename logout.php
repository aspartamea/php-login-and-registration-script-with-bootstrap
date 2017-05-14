<?php 
	include_once'config/Session.php';

	session_destroy();

	header('location: index.php');

?>