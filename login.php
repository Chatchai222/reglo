<?php require 'database.php'; ?>

<?php
session_start();

if(isset($_POST['submit'])){
    $REQUIRED_FIELD = array('email','password');
    $data_from_post = [];

    foreach($REQUIRED_FIELD as $field){
        array_push($data_from_post, $_POST[$field]);    
    };

    $form_data = array_combine($REQUIRED_FIELD, $data_from_post);

    $database = UserDatabase::get_instance();
    if($database->is_correct_login($form_data['email'], $form_data['password'])){
        echo "Sucessfully login <br>";
        header("Location: /reglo/welcome.php");
        $_SESSION['email'] = $form_data['email'];
    } else {
        echo "Error: Incorrect login info <br>";
    }
}

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
    </head>
    <body>

        <?php include "inc/header.php";?>

        <h1>Login Page</h1>
        
        <form method="post" action="">

            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <br>

            <label for="password">Password: </label>
            <input type="password" id="password" name="password">
            <br>

            <input type="submit" value="Login" name="submit"> 

        </form>

    </body>
</html>