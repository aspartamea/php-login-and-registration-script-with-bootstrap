<?php 
    include_once'config/Database.php';
    include_once'config/Utilities.php';

    //process the form 
    if(isset($_POST['registerBtn'])){
        //Initialise the array to store messages from form
        $form_errors = array();

        //form validation
        $required_fields = array('email', 'username', 'password');

        //call the function to check empty field and merge the return data into array
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

        //Fields that require checking for min length
        $fields_to_check_length = array('username' => 4, 'password' => 6);

        //Call the function to check min required length
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

        //Email validation 
        $form_errors = array_merge($form_errors, check_email($_POST));

        //Collect form data and store in vars
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(checkDuplicateEntries("users", "username", $username, $db)){
            $result = flashMessage("Username is already taken! Please try another one");
        }
        else if(checkDuplicateEntries("users", "email", $email, $db)){
            $result = flashMessage("email address is already being used! Please try another one");
        }

        //check if error array is empty, if yes process and insert data
        else if(empty($form_errors)){
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
                    $result = flashMessage("Registration Successful", "Pass");
                }
            }
            catch(PDOException $ex) {
                $result = flashMessage("An error has occurred " .$ex->getMessage());
            }
        }
        else {
            if(count($form_errors) == 1){
                $result = flashMessage("There was 1 error in the form<br>");
            }
            else {
                $result = falshMessage("There were " .count($form_errors). " errors in the form<br>");
            }
        }
    }
   
?>

<?php 
    $page_title = 'Register';
    include_once'includes/header.php'; 
?>
        <section id="register-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <h1>User Authentication system.</h1>
                        <h3>Register</h3>
                        <br>
                            
                        <?php if(isset($result)) echo $result; ?>
                        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
                    </div>
                    <div class="col-md-6 col-md-offset-3 text-center">

                        <form class="form-horizontal" action="" method="POST">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input class="form-control" type="text" placeholder="Your email address" name="email">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input class="form-control" type="text" placeholder="username" name="username" >
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
                                <input name="registerBtn" type="submit" value="Register" class="btn btn-primary btn-lg">
                                    
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
<?php include_once'includes/footer.php'; ?>