<?php require 'database.php'; ?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
    </head>
    <body>
        <h1>Profile Page</h1>
        <p>This is where your profile info is displayed</p>
        <?php
            session_start();
            $database = UserDatabase::get_instance();
            $user_infos = $database->get_user_info('chatchai@gmail.com');
            
            $database = UserDatabase::get_instance();
            $user_infos = $database->get_user_info($_SESSION['email']);
        
            if($user_infos != null){
                $user_infos = $user_infos[0];
                echo "Firstname: $user_infos[firstname] <br> 
                      Lastname: $user_infos[lastname] <br>
                      Email: $user_infos[email] <br>
                      Telephone number: $user_infos[telephonenumber] <br>
                      Password: $user_infos[password] <br>
                      ";
            } else {
                echo "Error: Something is wrong in retrieving info about user <br>";
            }
        ?>

        <?php include 'inc/footer.php';?>

    </body>
</html>