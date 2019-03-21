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
        
        public function searchUser($username, $password){
            $Query = $this->makeQuery($this->conn, "SELECT * FROM Accounts WHERE username = '$username'");
            $CheckQuery = mysqli_num_rows($Query);
            if($CheckQuery == 1) {
                $row = mysqli_fetch_assoc($Query);
                if($password == $row["password"]){
                    $this->console_log("Logged in!");
                    $_SESSION['username'] = $username;
                    $_SESSION['userType'] = parse_str($row["userType"]);
                    $_SESSION['firstname'] = $row["firstname"];
                    $_SESSION['lastname'] = $row["surename"];
                    $_SESSION['email'] = $row["email"];
                    $_SESSION['loggedin'] = true;
                    return true;
                }
                else {
                    echo parse_str($row['username']);
                    $this->console_log("User found, HOWEVER, password wrong");
                    return false;
                }
            }
            else {
                $this->console_log("User Username doesn't exist");
                return false;
            }
        }   

        public function storeNewUser($email, $username, $password, $firstname, $surename, $userType, $rePassword){
            if(empty($firstname) || empty($surename) || empty($email) || empty($username) || empty($password) || empty($rePassword)){
                $this->console_log("Feilds left empty!");
                return false;
            }

            if((strpos($email, '@') || strpos($email, '.') || filter_var($email, FILTER_VALIDATE_EMAIL)) == false){
                $this->console_log("Email invalid");
                return false;
            }

            if(($password.length > 8) || (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) == false){
                $this->console_log("password invalid");
                return false;
            }

            if($password != $rePassword){
                $this->console_log("passwords don't match");
                return false;
            }

            $sqlCheckUser = $this->makeQuery($this->conn, "SELECT * FROM Accounts;");
            if ($sqlCheckUser != NULL) {

                $userExists = false;
                while($rows = mysqli_fetch_rows($sqlCheckUser)) {
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