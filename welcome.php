<?php require 'database.php';?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome Page</title>
    </head>
    <body>
        <h1>Welcome Page</h1>
        <?php
            session_start();
            
            $database = UserDatabase::get_instance();
            $user_infos = $database->get_user_info($_SESSION['email']);
        
            if($user_infos != null){
                $user_infos = $user_infos[0];
                echo "Hello, $user_infos[firstname] $user_infos[lastname] <br>";
                
            } else {
                echo "Error: Something is wrong in retrieving info about user <br>";
                echo "Hello Guest <br>";
            }

        ?>

        <?php include 'inc/footer.php';?>
    </body>
</html>