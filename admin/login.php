

<?php
    require __DIR__ . '/../database.php';
    if(isset($_POST['submit'])){

        // Getting field from form
        $REQUIRED_FIELD = array('email','password');
        $data_from_post = [];
        foreach($REQUIRED_FIELD as $field){
            array_push($data_from_post, $_POST[$field]);    
        };

        $form_data = array_combine($REQUIRED_FIELD, $data_from_post);
        foreach($form_data as $index => $data){
            echo "$index -- $data <br>";
        }
        
        // Data validation
        $database = UserDatabase::get_instance();
        $pass_data_validation = true;
        if(in_array("",$form_data)){
            echo "Not all required field is entered <br>";
            $pass_data_validation = false;
        }
        if(! $database->is_correct_admin_login($form_data['email'], $form_data['password'])){
            echo "Incorrect login in detail <br>"; 
            $pass_data_validation = false;
        }

        // Logging in
        if($pass_data_validation){
            echo "Admin sucessfully logged in <br>";
            $_SESSION['adminemail'] = $form_data['email'];
            header("Location: welcome.php");
        } else {
            echo "Error: Incorrect data validation when logging as admin <br>";
        }

    }

?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login Page</title>
    </head>
    <body>
        <h1>Admin Login Page</h1>
        
        <form method="post" action="">

            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <br>

            <input type="submit" id="submit" name="submit" value="Login">

        </form>
        
        <a href="welcome.php">Welcome</a>
        <a href="manageuser.php">Manage User</a>
        <a href="logout.php">Log out</a>

    </body>
</html>