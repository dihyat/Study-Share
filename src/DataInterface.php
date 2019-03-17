<?php
    class DataInterface {
        private static $DInstance = null;
        private $servername = "localhost";
        private $dbuser = "root";
        private $dbpassword = "password";
        private $dbname = "Accounts";
        private $conn;

        private function __construct(){
            $this->conn = mysqli_connect($this->servername, $this->dbuser, $this->dbpassword, $this->dbname);
            if (mysqli_connect_errno()){
                console_log("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }

        public function searchUser($userName, $password){
            $sql = mysqli_query($this->conn, "SELECT * FROM Accounts");

            while($rows = mysqli_fetch_array($sql)) {
                if($userName == $rows["userName"]){
                    if($password == $rows["password"]){
                        return true;
                    }
                }
            }
            
            return false;
        }

        public function storeNewUser($email,$userName,$name,$password){
            $isAdmin = 1;
            $sqlCheckUser = mysqli_query($this->conn, "SELECT * FROM Accounts");
            $userExists = false;
            while($rows = mysqli_fetch_array($sqlCheckUser)) {
                if($userName == $rows["userName"]){
                    $userExists = true;
                }
            }

            if($userExists == true){
                console_log("user Exists");
                return;
            }

            $sql = mysqli_query($this->conn,"INSERT INTO Accounts (userName,password,name,email,isAdmin) VALUES ('$userName','$password','$name','$email','$isAdmin')");

            mysqli_query($this->conn,$sql);
        }

        public static function getInstance(){
            if (self::$DInstance == null){
                self::$DInstance = new DataInterface();
            }
            return self::$DInstance;
        }

    }
?>