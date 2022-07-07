<?php require 'database.php'; ?>

<?php

/*
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$telephone_number = $_POST['telephonenumber'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmpassword'];

echo "Data entered into the form <br>";
echo "First name: " . $first_name . "<br>";
echo "Last name: " . $last_name . "<br>";
echo "Email: " . $email . "<br>";
echo "Telephone number: " . $telephone_number . "<br>";
echo "Password: " . $password . "<br>";
echo "Confirm password: " . $confirm_password . "<br>";
*/
if(isset($_POST['submit'])){
    $REQUIRED_FIELD = array('firstname','lastname','email','telephonenumber','password','confirmpassword');
    $data_from_post = [];
    foreach($REQUIRED_FIELD as $field){
        array_push($data_from_post, $_POST[$field]);    
    };

    $form_data = array_combine($REQUIRED_FIELD, $data_from_post);
    /*
    foreach($form_data as $i => $data){
        echo $i . " -- " . $data . "<br>";
        var_dump($data);
        echo "<br>";
    }
    */

    // For data validation to enter database
    $database = UserDatabase::get_instance();
    $pass_data_validation = true;
    if(in_array("",$form_data)){
        echo "Not all required field is entered <br>";
        $pass_data_validation = false;
    }
    if($form_data['password'] !== $form_data['confirmpassword']){
        echo "Password and confirmed password is not the same <br>";
        $pass_data_validation = false;
    }
    if($database->is_email_in_database($form_data['email'])){
        echo "Email already in use <br>";
        $pass_data_validation = false;
    }

    // Storing user into database
    if($pass_data_validation){
        try{
            $database->insert_user($form_data);
            echo "Sucessfully stored user info into database<br>";
        } catch (Exception $e) {
            echo "Error: Fail to insert user into database<br>";
            echo $e->getMessage() . "<br>";
        }
        
    } else {
        echo "Error: Something is wrong with data validation, user info not stored into database<br>";
    };
}


?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registration page</title>
    </head>
    <body>

        <?php include "inc/header.php";?>

        <h1>User registration page</h1>

        <form method="post" action="">
            
            <label for="firstname">First name:</label>
            <input type="text" id="firstname" name="firstname">
            <br>

            <label for="lastname">Last name:</label>
            <input type="text" id="lastname" name="lastname">
            <br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <br>

            <label for="telephonenumber">Telephone Number:</label>
            <input type="text" id="telephonenumber" name="telephonenumber">
            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <br>

            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" id="confirmpassword" name="confirmpassword">
            <br>

            <input type="submit" id="submit" name="submit" value="Register Account">

        </form> 

    </body>
</html>