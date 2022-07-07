<?php

session_start();
session_destroy();
echo "Sucessfully logged out <br>";
header("Location: login.php");

?>