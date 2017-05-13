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
            
            <title>Welcome | User authentication system</title>
	</head>
	<body>
            <section id="index-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                            <h1>User Authentication system.</h1>
                            <br>
                            <div id="loreg">
                                <a class="btn btn-primary btn-lg" href="login.php">Login</a>
                                <a class="btn btn-primary btn-lg" href="register.php">Register</a>
                            </div>
                            <div id="usr">
                                <p>
                                    You're logged in as {username} <a href="logout.php">Logout</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <div class="alert alert-success" role="alert">
                                <?php include_once'config/Database.php';?>
                            </div>
                        </div>    
                    </div>
                </div>
            </section>
	</body>
</html>