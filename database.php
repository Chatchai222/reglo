<?php 

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

    public function update_user_info($in_email, $user_infos){
        try{
            $sql = "
            UPDATE `user`
            SET `firstname`='$user_infos[firstname]',
                `lastname`='$user_infos[lastname]',
                `telephonenumber`='$user_infos[telephonenumber]'
            WHERE email='$in_email'
            ";
            mysqli_query($this->conn, $sql);

        } catch (Exception $e){
            echo "Error: At updating user info<br>";
            echo $e->getMessage() . "<br>";
        }
    }

    public function update_user_password($in_email, $new_password){
        try{
            $sql = "
            UPDATE `user`
            SET `password`='$new_password'
            WHERE email='$in_email'
            ";
            mysqli_query($this->conn, $sql);

        } catch (Exception $e){
            echo "Error: At updating user password<br>";
            echo $e->getMessage() . "<br>";
        }
    }

    public function execute_sql_query($in_sql){
        try{

            $result = mysqli_query($this->conn, $in_sql);
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            if(empty($result)){
                return null;
            } else {
                return $result;
            }

        } catch (Exception $e){
            echo "Error: At execute sql query<br>";
            echo "Query is $in_sql <br>";
            echo "Error exception message:" . $e->getMessage() . "<br>";
            return null;
        }

    }    
}


?>