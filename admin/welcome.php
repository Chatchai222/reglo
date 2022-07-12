<?php
    require __DIR__ . '/../database.php';
    
    $database = UserDatabase::get_instance();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin welcome page</title>
    </head>
    <body>
        <h1>Admin Welcome Page</h1>

        <a href="welcome.php">Welcome</a>
        <a href="manageuser.php">Manage User</a>
        <a href="logout.php">Log out</a>

    </body>
</html>
