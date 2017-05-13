<?php 
	$dsn = 			'mysql:host=localhost'; //Do not change this 
        $dbName =               'dbname=login_register_script'; //Change the name of the DB here 
	$username =             'matt'; //Change your database username here
	$pwd = 			'password'; //Change your db password here
	

	try {
            
            //Create the connection 
            $db = new PDO($dsn, $username, $pwd);
            
            //set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //Display succesfull connection message
            echo "Connection successful";

	}
	catch (PDOException $ex) {
            //Display error message
            echo "Connection failed ".$ex->getMessage();
        }




	