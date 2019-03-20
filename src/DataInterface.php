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
            $sql = $this->makeQuery($this->conn, "SELECT * FROM Userdata");
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
            $sqlCheckUser = $this->makeQuery($this->conn, "SELECT * FROM userdata");
            if ($sqlCheckUser != NULL) {

                $userExists = false;
                while($rows = mysqli_fetch_array($sqlCheckUser)) {
                    if($userName == $rows["userName"]){
                        $userExists = true;
                    }
                }

                if($userExists == true){
                    $this->console_log("user Exists");
                    return false;
                }
            }

            $sql = 'INSERT INTO userdata VALUES (' .
            strval($email) .',' .
            strval($username) . ',' .
            strval($password) . ',' .
            strval($firstname) . ',' .
            strval($surename) . ',' .
            strval($userType) .
            ');';
            $this->makeQuery($this->conn,$sql);
            return true;
        }

        //Extra function
        public function makeQuery($connection, $Query){
            if(mysqli_query($connection, $Query)) {
                $this->console_log("User Created");
            } 
            else {
                $this->console_log("Error creating Entry");
                echo mysqli_error($this->conn);
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