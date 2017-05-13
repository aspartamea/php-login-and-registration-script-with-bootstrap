<?php 
    //Add the db con
    include_once'config/Database.php';

    //process the form 
    if(isset($_POST['registerBtn'])){
        //Initialise the array to store messages from form
        $form_errors = array();

        //form validation
        $required_fields = array('email', 'username', 'password');

        //loop through the required fields 
        foreach($required_fields as $name_of_field){
            if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL){
                $form_errors[] = $name_of_field . " is a required field";
            }
        }

        //check if error array is empty, if yes process and insert data
        if(empty($form_errors)){
            //Collect form data and store in vars
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            //Hash the pwd
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            try{
                //Create SQL insert 
                $sqlInsert = "INSERT INTO users (username, email, password, join_date)
                                VALUES (:username, :email, :password, now())";

                //sanitise data
                $statement = $db->prepare($sqlInsert);

                //Add data into the db 
                $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

                //Check if one new row has been created 
                if($statement->rowCount() == 1){
                    $result = '
                        <div class="alert alert-success">
                            Registration successful!
                        </div>
                    ';
                }
            }
            catch(PDOException $ex) {
                $result = '
                    <div class="alert alert-warning">
                        An error occured: '.$ex->getMessage().'
                    </div>
                ';
            }
        }
        else {
            if(count($form_errors) == 1){
                $result = '<div class="alert alert-warning">There was 1 error in the form<br>';

                $result .= '<ul>';
                //loop through array and display all items 
                foreach($form_errors as $error){
                    $result .= '<li> {$error} </li>';
                }
                $result .= '</ul></div>';
            }
            else {
                $result = '<div class="alert alert-warning"> There were ' .count($form_errors). 'errors in the form<br>';
                $result .= '<ul>';
                //loop through array and display all items 
                foreach($form_errors as $error){
                    $result .= '<li> {$error} </li>';
                }
                $result .= '</ul></div>';
            }
        }
    }
   
?>

<!DOCTYPE html>
<html>
	<head lang="en">
            <!--<meta charset="utf-8"> -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="robots" content="all,follow">
            <meta name="googlebot" content="index,follow,snippet,archive">
            
            <!-- link the connector stylsheet -->
            <link rel="stylesheet" href="style.css">
            
            <!-- link google font -->
            <link href="https://fonts.googleapis.com/css?family=Yrsa" rel="stylesheet">
            
            <title>Register | User authenication system</title>
	</head>
	<body>
        <section id="register-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <h1>User Authentication system.</h1>
                        <br>
                            
                        <div id="usr">
                            <p>
                                <a href="index.php">Back</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3 text-center">

                    <?php 
                        if(isset($result)) {
                            echo $result; 
                        }
                    ?>

                        <form class="form-horizontal" id="lo-form" action="" method="POST">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input class="form-control" type="text" placeholder="Your email address" name="email" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" placeholder="username" name="username" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input class="form-control" type="password" placeholder="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12 button text-center">
                                <input name="registerBtn" type="submit" value="Register" class="btn btn-primary btn-lg">
                                    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
	</body>
</html>