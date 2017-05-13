<?php 
    
    include_once'config/Database.php';

    if(isset($_POST['email'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sqlInsert = "INSERT INTO users (username, email, password, join_date)
                    VALUES (:username, :email, :password, now())";

        try {
            $statement = $db->prepare($sqlInsert);
            $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $password));

            if($statement->rowCount() == 1) {
                $result = '
                            <div class="alert alert-success" role="alert">
                                Registration successful.<br>
                            </div>
                        ';
            }
        }
        catch(PDOException $ex) {
            $result = '
                        <div class="alert alert-warning" role="alert">
                            An error has occured: '.$ex->getMessage().'
                        </div>
                    ';
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
                                    <input class="form-control" type="text" value="" placeholder="Your email address" name="email">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" value="" placeholder="username" name="username" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input class="form-control" type="password" value="" placeholder="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group col-md-12 button text-center">
                                <button name="submit" type="submit" class="btn btn-primary btn-lg" value="Singin">
                                    Register 
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
	</body>
</html>