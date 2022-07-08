<?php require 'database.php'?>

<?php

    session_start();

    if(isset($_POST['submit'])){
        $REQUIRED_FIELD = array('firstname','lastname','telephonenumber');
        $data_from_post = [];
        foreach($REQUIRED_FIELD as $field){
            array_push($data_from_post, $_POST[$field]);    
        };

        $form_data = array_combine($REQUIRED_FIELD, $data_from_post);
        
        /*
        // Debugging purpose
        foreach($form_data as $index => $data){
            echo $index . " -- " . $data . "<br>";
        }
        */

        $pass_data_validation = true;
        if(in_array("",$form_data)){
            echo "Not all required field is entered <br>";
            $pass_data_validation = false;
        }
        
        $database = UserDatabase::get_instance();
        if($pass_data_validation){
            try{
                $database->update_user_info($_SESSION['email'], $form_data);
                echo "Sucessfully updated user info <br>";
            } catch (Exception $e) {
                echo "Error: Something went wrong when updating user info <br>";
                echo $e->getMessage() . "<br>";
            }
            
        } else {
            echo "Error: Something went wrong with data validation, abort updating user profile <br>";
        }

        
        

        

    }

    
    
    
    


?>



<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile Page</title>
    </head>
    <body>
        <h1>Edit Profile Page</h1>
        <form method="post" action="">
            
            <label for="firstname">First name:</label>
            <input type="text" id="firstname" name="firstname">
            <br>

            <label for="lastname">Last name:</label>
            <input type="text" id="lastname" name="lastname">
            <br>

            <label for="telephonenumber">Telephone number:</label>
            <input type="text" id="telephonenumber" name="telephonenumber">
            <br>
            
            <input type="submit" id="submit" name="submit" value="Update profile">

        </form> 
    </body>

    <?php include 'inc/footer.php'?>
</html>
