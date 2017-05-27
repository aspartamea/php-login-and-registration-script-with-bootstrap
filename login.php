<?php 
    include_once'config/Session.php';
    include_once'config/Database.php';
    include_once'config/Utilities.php';

    if(isset($_POST['loginBtn'])){
        //initialise the array 
        $form_errors = array();

        //Validate the form
        $required_fields = array('username', 'password');

        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        if(empty($form_errors)){
            //Collect the form data
            $user = $_POST['username'];
            $password = $_POST['password'];

            //check if user exists in the db 
            $sqlQuery = "SELECT * FROM users WHERE username = :username";
            $statement = $db->prepare($sqlQuery);
            $statement->execute(array(':username' => $user));

            //fetch data from DB & compare it with inputted data 
            while($row = $statement->fetch()){
                $id = $row['id'];
                $hashed_password = $row['password'];
                $username = $row['username'];

                //If pwd's match create the session 
                if(password_verify($password, $hashed_password)){
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $username;
                    //Change below here to where you want users to be redirected upon login
                    header("location: dashboard.php");
                }
                else{
                    $result = flashMessage("Invalid username or password!");
                }
            }


        }
        else {
            if(count($form_errors) == 1) {
                $result = flashMessage("There was 1 error in the form<br>");
            }
            else {
                $result = flashMessage('There were ' .count($form_errors). ' errors in the form<br>'); 
            }
        }
    }
    
?>

<!DOCTYPE html>
<html>
	<head lang="en">
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="robots" content="all,follow">
            <meta name="googlebot" content="index,follow,snippet,archive">
            
            <!-- link the connector stylsheet -->
            <link rel="stylesheet" href="style.css">
            
            <!-- link google font -->
            <link href="https://fonts.googleapis.com/css?family=Yrsa" rel="stylesheet">
            
            <title>Login | User authenication system</title>
	</head>
	<body>
        <section id="login-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <h1>User Authentication system.</h1>
                        <h3>Login</h3>
                        <br>

                        <?php if(isset($result)){
                            echo $result;
                        } ?>
                        <?php if(!empty($form_errors)){
                            echo show_errors($form_errors);
                        } ?>
                    </div>
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <form class="form-horizontal" action="" method="POST">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" placeholder="username" name="username">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input class="form-control" type="password" placeholder="password" name="password">
                                </div>
                            </div>
                            <div class="form-group col-md-12 button text-center">
                                <input name="loginBtn" type="submit" class="btn btn-primary btn-lg" value="Login"><br />
                                <a href="forgot_pwd.php">Forgotten password?</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <div id="usr">
                            <p>
                                <a href="index.php">Back</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	</body>
</html>