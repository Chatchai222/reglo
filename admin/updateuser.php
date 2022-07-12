
<?php
    require __DIR__ . "/../database.php";
    echo "Hello admin edit user <br>";
    var_dump($_GET);


    if(isset($_GET['updateuseremail'])){

        $user_email = $_GET['updateuseremail'];

        if(isset($_POST['submit'])){
            echo "User has clicked sumbit form button <br>";
            $REQUIRED_FIELD = array('firstname','lastname','telephonenumber');
            $data_from_post = [];
            foreach($REQUIRED_FIELD as $field){
                array_push($data_from_post, $_POST[$field]);    
            };
    
            $form_data = array_combine($REQUIRED_FIELD, $data_from_post);
            
            $pass_data_validation = true;
            if(in_array("",$form_data)){
                echo "Error: Not all required field is entered <br>";
                $pass_data_validation = false;
            }
            
            $database = UserDatabase::get_instance();
            if($pass_data_validation){
                try{
                    $database->update_user_info($user_email, $form_data);
                    echo "Sucessfully updated user into database";
                } catch (Exception $e){
                    echo "Error: Storing updating user info into database <br>";
                    echo "$e->getMessage()";
                }
            } else {
                echo "Error: There is something wrong with data validation <br>";
            }

            
        } else {
            echo "User have not clicked submit form button yet <br>";
        }

    } else {
        echo "Error: _GET doesn't have updateuseremail <br>";
    }


?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Update User</title>
    </head>
    <body>
        <h1>Admin Update User</h1>

        <?php
        echo $user_email . "<br>";
        ?>

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
        
        <a href="welcome.php">Welcome</a>
        <a href="manageuser.php">Manage User</a>
        <a href="logout.php">Log out</a>
    </body>
</html>

