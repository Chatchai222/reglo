

<?php
    require __DIR__ . '/../database.php';
    if(isset($_POST['submit'])){
        $REQUIRED_FIELD = array('email','password');
        $data_from_post = [];
        foreach($REQUIRED_FIELD as $field){
            array_push($data_from_post, $_POST[$field]);    
        };

        $form_data = array_combine($REQUIRED_FIELD, $data_from_post);
        foreach($form_data as $index => $data){
            echo "$index -- $data <br>";
        }
        
        $database = UserDatabase::get_instance();
        $pass_data_validation = true;
        if(in_array("",$form_data)){
            echo "Not all required field is entered <br>";
            $pass_data_validation = false;
        }
        if(empty($database->execute_sql_query
                (
            "SELECT * FROM `admin` 
            WHERE email=$form_data[email] 
            and password=$form_data[password]"
                )
            )
        ){
            echo "Error:Incorrect login details <br>";
            $pass_data_validation = false;
        }

        $result = $database->execute_sql_query
                (
            "SELECT * FROM `admin` 
            WHERE email=$form_data[email] 
            and password=$form_data[password]"
                );
        echo "<br><br>";
        var_dump($result);
        echo "<br><br>";


        if($pass_data_validation){
            echo "Sucessfully login <br>";
            $_SESSION['adminemail'] = $form_data['email'];
        } else {
            echo "Error: Something went wrong with data validation, abort login <br>";
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

        <a href="/reglo/register.php">Register</a>

    </body>
</html>