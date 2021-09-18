<?php
//DEclaring variables to prevent error
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = ""; // sign up date
$error_array = array();// Hold Error Msg

if(isset($_POST['register_button'])){

    //registration form values

    //First name
    $fname = strip_tags($_POST['reg_fname']); //remove HTML tags
    $fname = str_replace(' ', '', $fname); // remove spaces
    $fname = ucfirst((strtolower($fname)));// uppercase first letter
    $_SESSION['reg_fname'] = $fname;// store first name

    // Last name
    $lname = strip_tags($_POST['reg_lname']); //remove HTML tags
    $lname = str_replace(' ', '', $lname); // remove spaces
    $lname = ucfirst((strtolower($lname)));// uppercase first letter
    $_SESSION['reg_lname'] = $lname; //store first name

    //Email
    $em = strip_tags($_POST['reg_email']); //remove HTML tags
    $em = str_replace(' ', '', $em); // remove spaces
    $em = ucfirst((strtolower($em)));// uppercase first letter
    $_SESSION['reg_email'] = $em; //store first name

    //email 2
    $em2 = strip_tags($_POST['reg_email2']); //remove HTML tags
    $em2 = str_replace(' ', '', $em2); // remove spaces
    $em2 = ucfirst((strtolower($em2)));// uppercase first letter
    $_SESSION['reg_email2'] = $em2;//store first name

    //Password
    $password = strip_tags($_POST['reg_password']); //remove HTML tags
    $password2 = strip_tags($_POST['reg_password2']); //remove HTML tags

    //Date
    $date = date("Y-m-d");

    if($em == $em2){
        //check if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)){
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            // check if email is already exist
            $e_check = mysqli_query($con, "SELECT email FROM user WHERE email='$em'");

            // count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0){
                array_push($error_array, "Email is already been used <br>");
            }
        } else {
            array_push($error_array, "Invalid format<br>");
        }

    } else {
        array_push($error_array, "Email don't match<br>");
    }

    if(strlen($fname) >= 25 || strlen($fname) < 2){
        array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
    }

    if(strlen($lname) >= 25 || strlen($lname) < 2){
        array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
    }

    if($password != $password2){
        echo "Your password did not match<br>";
    } else {
        if(preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($error_array, "Your password can only contain characters or number<br>");
        }   
    
    }

    if(strlen($password) > 30 || strlen($password) < 5){
        array_push($error_array, "Your password must be between 5 and 30 characters<br>");
    }

    if(empty($error_array)){
        $password = md5($password); // Encrypt password before sending to database

        // generate username by concatenating first name and last name 
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM user WHERE username ='$username'");

        $i = 0;
        while(mysqli_num_rows($check_username_query) != 0){
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username FROM user WHERE username ='$username'");
        }
        
        //profile picture
        $rand = rand(1,2);// random number

        if($rand == 1){
            $profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
        } else if($rand == 2){
            $profile_pic = "assets/images/profile_pics/defaults/head_pomegranate.png";
        }
        
        $query = mysqli_query($con, "INSERT INTO user VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

        array_push($error_array, "<span style='color: #ff0000;'> You are all set</span>");

        //Clear Session
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
  
    }
}
?>