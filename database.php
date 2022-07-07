<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'chatchai');
define('DB_PASS', '123456');
define('DB_NAME', 'reglo');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    echo "Database connected sucessfully<br>";
}

class UserDatabase{

    private static $instance = null;
    private static $DB_HOST = 'localhost';
    private static $DB_USER = 'chatchai';
    private static $DB_PASS = '123456';
    private static $DB_NAME = 'reglo';
    private $conn = null;

    private function __construct(){
        $this->conn = new mysqli(self::$DB_HOST, self::$DB_USER, self::$DB_PASS, self::$DB_NAME);
        
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error . "<br>");
        } else {
            echo "Database connected sucessfully<br>";
        }
    }

    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new UserDatabase();
        }

        return self::$instance;
    }

    public function get_connection(){
        return $this->conn;
    }

    public function is_email_in_database($in_email){
        $sql = "SELECT * FROM `user` where email='$in_email'";
        $result = mysqli_query($this->conn, $sql);
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        if(empty($result)){
            return false;
        } else {
            return true;
        }
    }

    public function insert_user($user_infos){
        try{
            $sql = "
            INSERT INTO `user`(`firstname`, `lastname`, `email`, `telephonenumber`, `password`) 
            VALUES ('$user_infos[firstname]','$user_infos[lastname]','$user_infos[email]','$user_infos[telephonenumber]','$user_infos[password]')
            ";
            mysqli_query($this->conn, $sql);
        } catch (Exception $e){
            echo "Error inserting user into database<br>";
            echo $e->getMessage() . "<br>";
        }
    }

    public function is_correct_login($in_email, $in_password){
        try{
            $sql = "SELECT * FROM `user` where email='$in_email' and password='$in_password'";
            $result = mysqli_query($this->conn, $sql);
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            if(empty($result)){
                return false;
            } else {
                return true;
            }

        } catch (Exception $e){
            echo "Error: Checking is_correct_login <br>";
            echo $e->getMessage() . "<br>";
            return false;
        }
    }

    public function get_user_info($in_email){
        try{
            $sql = "SELECT * FROM `user` WHERE email='$in_email'";
            $result = mysqli_query($this->conn, $sql);
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            if(empty($result)){
                return null;
            } else {
                return $result;
            }

        } catch (Exception $e){
            echo "Error: At getting user info<br>";
            echo $e->getMessage() . "<br>";
            return null;
        }
        

    }

    
}


?>