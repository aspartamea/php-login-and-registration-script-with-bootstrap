<?php 
	include_once'config/Database.php';
	include_once'config/Utilities.php';

	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];

		$sqlQuery = "SELECT * FROM users WHERE id = :id";
		$statement = $db->prepare($sqlQuery);
		$statement->execute(array(':id' => $id));

		while($rs = $statement->fetch()){
			$username = $rs['username'];
			$email = $rs['email'];
			$date_joined = strftime("%d %b %Y", strtotime($rs["join_date"]));
		}

		$encode_id = base64_encode("encodeuserid{$id}");
	}