<?php include 'database.php';?>

<?php
    session_start();
    
    if(isset($_POST['submit'])){
        $REQUIRED_FIELD = ['oldpassword','newpassword','confirmnewpassword'];
        $data_from_post = [];
        foreach($REQUIRED_FIELD as $field){
            array_push($data_from_post, $_POST[$field]);    
        };

        $form_data = array_combine($REQUIRED_FIELD, $data_from_post);
        
        $database = UserDatabase::get_instance();
        $pass_data_validation = true;
        if(in_array("",$form_data)){
            echo "Not all required field is entered <br>";
            $pass_data_validation = false;
        }
        if($form_data['newpassword'] !== $form_data['confirmnewpassword']){
            echo "Error: New password and confirmed new password is not the same <br>";
            $pass_data_validation = false;
        }
        if(! $database->is_correct_login($_SESSION['email'],$form_data['oldpassword'])){
            echo "Error: Wrong old password or email is not in session <br>";
            $pass_data_validation = false;
        }

        if($pass_data_validation){
            try{
                $database->update_user_password($_SESSION['email'],$form_data['newpassword']);
                echo "Sucessfully updated password <br>";
            } catch (Exception $e){
                echo "Error: Database error in updating password <br>";
            }
        } else {
            echo "Error: Something went wrong with data validation for changing password, abort changing password <br>";
        }

    }

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
    </head>
    <body>
        <h1>Change Password Page</h1>
        <form method="post" action="">

            <label for="oldpassword">Old Password:</label>
            <input type="text" id="oldpassword" name="oldpassword">
            <br>

            <label for="newpassword">New Password:</label>
            <input type="text" id="newpassword" name="newpassword">
            <br>

            <label for="confirmnewpassword">Confirm New Password:</label>
            <input type="text" id="confirmnewpassword" name="confirmnewpassword">
            <br>
            
            <input type="submit" id="submit" name="submit" value="Update Password">


        </form>
        
        

    </body>
    <?php include 'inc/footer.php';?>

</html>