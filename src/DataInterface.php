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
                $this->console_log("Failed to connect to MySQL: " . mysqli_connect_error());
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
            $sql = $this->makeQuery($this->conn, "SELECT * FROM Accounts");
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
            $sqlCheckUser = $this->makeQuery($this->conn, "SELECT * FROM Accounts;");
            if ($sqlCheckUser != NULL) {
                $userExists = false;
                while($rows = mysqli_fetch_array($sqlCheckUser)) {
                    if($username == $rows["username"]){
                        $userExists = true;
                    }
                }

                if($userExists == true){
                    $this->console_log("User Exists");
                    return false;
                }
            }
            else {
                $this->console_log("SQLCheckerFailed!");
                die("Error checking for useranme matches");
            }

            $sql =  "INSERT INTO Accounts (email,username,password,firstname,surename,userType) 
                    VALUES ('$email','$username', '$password', '$firstname', '$surename', '$userType');";
            $this->makeQuery($this->conn,$sql);
            return true;
        }

        //Extra function
        public function makeQuery($connection, $Query){
            $Q = mysqli_query($connection, $Query);
            if($Q == False) {
                $this->console_log("Error creating Entry");
                echo mysqli_error($this->conn);
                return Null;
            } 
            else {
                $this->console_log("Query was a success!"); 
                return $Q;   
            }
        }

        public function console_log($data) {
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
        } 

        public function getConnection() {
            return $this->conn;
        }

    }//end class
?>	