<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
    <title>Hello</title>
</head>
<body>

    <?php
        if(isset($_POST['register_button'])){
            echo '<script>

            $(document).ready(function(){
                $("#first").hide();
                $("#second").show();

            });

            </script>';
        }
    ?>
    
   <div class="wrapper">
   
       <div class="login_box">
       <div class="login_header">
           <h1>Hello!</h1>
           Sign in to my website!
       </div>
       <div id="first">
        <form action="register.php" method="POST">
                <input type="email" name="log_email" id="" placeholder="Email Address" value="<?php
                if(isset($_SESSION['log_email'])){
                    echo $_SESSION['log_email'];
                }
                ?>" require>
                <br>
                <input type="password" name="log_password" placeholder="Password">
                <br>
                <?php if(in_array("Email or password was incorrect<br>", $error_array)) echo "Email or password was incorrect<br>";?>
                <input type="submit" name="login_button" value="Login">
                <br>
                <a href="#" id="signup" class="signup">Need an account? Register here!</a>

            </form>
        
            <br>
       </div>
        
        <div id="second">
            <form action="register.php" method="POST">
                <input type="text" name="reg_fname" placeholder="First Name" value="<?php
                if(isset($_SESSION['reg_fname'])){
                    echo $_SESSION['reg_fname'];
                }
                ?>" require>
                <br/>
                <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array))echo "Your first name must be between 2 and 25 characters<br>"; ?>
                
                <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
                if(isset($_SESSION['reg_lname'])){
                    echo $_SESSION['reg_lname'];
                }
                ?>" require>
                <br/>
                <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array))echo "Your first name must be between 2 and 25 characters<br>"; ?>


                <input type="text" name="reg_email" placeholder="Email" value="<?php
                if(isset($_SESSION['reg_email'])){
                    echo $_SESSION['reg_email'];
                }
                ?>" require>
                <br/>

                
                <input type="text" name="reg_email2" placeholder="Confirm Email" value="<?php
                if(isset($_SESSION['reg_email2'])){
                    echo $_SESSION['reg_email2'];
                }
                ?>" require>
                <br>
                <?php if(in_array("Email is already been used <br>", $error_array)) echo "Email is already been used <br>";
                else if(in_array("Invalid format<br>", $error_array)) echo "Invalid format<br>";
                else if(in_array("Email don't match<br>", $error_array)) echo "Email don't match<br>"; ?>

                <input type="password" name="reg_password" placeholder="Password" require>
                <br>
                <input type="password" name="reg_password2" placeholder="Confirm Password" require>
                <br>
                <?php if(in_array("Your password did not match<br>", $error_array)) echo "Your password did not match<br>";
                else if(in_array("Your password can only contain characters or number<br>", $error_array)) echo "Your password can only contain characters or number<br>";
                else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>

                <input type="submit" name="register_button" placeholder="Register">
                <br>
                <?php if(in_array("<span style='color: #ff0000;'> You are all set</span>", $error_array))echo "<span style='color: #ff0000;'> You are all set</span>"; ?>
                <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
            </form>
        </div>
    
    </div>
   </div>
</body>
</html>