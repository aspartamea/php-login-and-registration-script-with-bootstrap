<?php
	include_once'config/Database.php';
	include_once'config/Utilities.php';

	//Process the form when button is pressed
	if(isset($_POST['pwdResetBtn'])) {
		//initilise the array
		$form_errors = array();

		//form validation 
		$required_fields = array('email', 'new_password', 'confirm_password');

		//check empty fields and merge the return data
		$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

		//Set required length for fields that require it
		$fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

		//merge data into array
		$form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

		//Email validation
		$form_errors = array_merge($form_errors, check_email($_POST));

		//check if error array is empty, if yes process
		if(empty($form_errors)){
			//collect the data from the form
			$email = $_POST['email'];
			$password1 = $_POST['new_password'];
			$password2 = $_POST['confirm_password'];

			//check if new passwords match
			if($password1 != $password2){
				$result = flashMessage("Passwords do not match!");
			}
			else {
				try{
					//create SQL statement and see if email exists in db
					$sqlQuery = "SELECT email FROM users WHERE email = :email";

					//sanitise it
					$statement = $db->prepare($sqlQuery);

					//make it run
					$statement->execute(array(':email' => $email));

					//Check if email add exits
					if($statement->rowCount() == 1) {
						//has the pwd
						$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

						//Update the pwd
						$sqlUpdate = "UPDATE users SET password = :password WHERE email = :email";

						//Sanitise it 
						$statement = $db->prepare($sqlUpdate);

						//make it run
						$statement->execute(array(':password' => $hashed_password, ':email' => $email));

						$result = '<div class="alert alert-success" role="alert">Passwas has been reset</div>';
					}
					else {
						$result = flashMessage("The email address provided does not exist, please try again");
					}
				}
				catch (PDOException $ex){
					$result = flashMessage("An error occurred: " .$ex->getMessage());
				}
			}
		}
		else {
			if(count($form_errors) == 1) {
				$result = falshMessage("There was 1 error in the form <br>");
			}
			else {
				$result = flashMessage("There were " .count($form_errors). " errors in the form <br>");
			}
		}
	}
?>