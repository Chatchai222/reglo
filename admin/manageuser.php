
<?php
    require __DIR__ . "/../database.php";
    
    $database = UserDatabase::get_instance();

    var_dump($_GET);
    echo "<br>";

    if(isset($_GET['deleteuseremail'])){
        echo "Button clicked $_GET[deleteuseremail]  <br>";
        $user_email = $_GET['deleteuseremail'];
        $database->delete_user_info($user_email);
        $_GET = []; // clear
        header("Location: manageuser.php");
    }
    
    $result = $database->get_all_user_info();
    if($result != null){
        echo "<table>";
        // Table header
        echo "<tr>";
        foreach(array_keys($result[0]) as $keys){
            echo "<th>$keys</th>";    
        }
        echo "</tr>";

        // Table data
        foreach($result as $user){
            echo "<tr>";
            foreach($user as $info){
                echo "<td>$info</td>";
            }
            echo "<td>" . "<a href=manageuser.php" . "?deleteuseremail=" . "$user[email]" . " >Delete</a>" . "</td>";
        }
        echo "</table>";
    } else {
        echo "There is no user in the database or there is an Error <br>";
    }


?>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage user page</title>
    </head>

    <body>
        <h1>Manage User Page</h1>

    </body>

    


    <a href="welcome.php">Welcome</a>
    <a href="manageuser.php">Manage User</a>
    <a href="logout.php">Log out</a>
    

</html>
