<?php
    class DataInterface {
        private static $DInstance = null;

        private $servername = "localhost";
        private $dbuser = "root";
        private $dbpassword = "";
        private $dbname = "studysharedb1";

        private $conn;
        
        private function __construct(){
            $this->conn = mysqli_connect($this->servername, $this->dbuser, $this->dbpassword, $this->dbname);
            if (mysqli_connect_errno()){
                console_log("Failed to connect to MySQL: " . mysqli_connect_error());
                die("DB Error: please try again later"); 
            }
        }

        public static function getInstance(){
            if (self::$DInstance == null){
                self::$DInstance = new DataInterface();
            }
            return self::$DInstance;
        }
        
        public function searchUser($userName, $password){
            $sql = makeQuery($this->conn, "SELECT * FROM UserData");
            while($rows = mysqli_fetch_array($sql)) {
                if($userName == $rows["username"]){
                    if($password == $rows["password"]){
                        return true;
                    }
                    else {
                        //Password wrong, user found
                        return false;
                    }
                }
                else {
                    //UserName doesn't exist
                    return false;
                }
            }   
            return false;
        }

        public function storeNewUser($email,$username,$password,$firstname,$surename,$userType){
            //$isAdmin = 1;
            $sqlCheckUser = makeQuery($this->conn, "SELECT * FROM UserData");
            $userExists = false;
            while($rows = mysqli_fetch_array($sqlCheckUser)) {
                if($userName == $rows["userName"]){
                    $userExists = true;
                }
            }

            if($userExists == true){
                console_log("user Exists");
                return false;
            }

            $sql = 'INSERT INTO UserData VALUES (' .
            strval($email) .',' .
            strval($userName) . ',' .
            strval($password) . ',' .
            strval($firstname) . ',' .
            strval($surename) . ',' .
            strval($userType) .
            ');';
            makeQuery($this->conn,$sql);
            return true;
        }

        //Extra function
        public function makeQuery($connection, $Query){
            if(mysqli_query($connection, $Query)) {
                console_log("User Created");
            } 
            else {
                console_log("Error creating Entry: " . mysqli_error($con) );
            }
        }

        function console_log($data) {
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
        } 

    }//end class
?>	