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
                        $_SESSION['username'] = $username;
                        $_SESSION['userType'] = parse_str($row["userType"]);
                        $_SESSION['firstname'] = $row["firstname"];
                        $_SESSION['lastname'] = $row["surename"];
                        $_SESSION['email'] = $row["email"];
                        $_SESSION['loggedIn'] = true;
                        $this->LogInOut(true);
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
                return 1;
            }

            if((strpos($email, '@') || strpos($email, '.') || filter_var($email, FILTER_VALIDATE_EMAIL)) == false){
                $this->console_log("Email invalid");
                return 2;
            }

            if((strlen($password) < 8) || (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-].*[0-9]|[0-9]/', $password)) == false){
                $this->console_log("password invalid");
                return 3;
            }

            if($password != $rePassword){
                $this->console_log("passwords don't match");
                return 4;
            }

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
                    return 5;
                }
            }
            else {
                $this->console_log("SQLCheckerFailed!");
                return 6;
            } 
            $sql =  "INSERT INTO Accounts (email,username,password,firstname,surename,userType) 
                    VALUES ('$email','$username', '$password', '$firstname', '$surename', '$userType');";
            $this->makeQuery($this->conn,$sql);
            return 0;

            //allocating user storage on server
            $pathnameAlevel = $_SERVER['DOCUMENT_ROOT'] . '/Study-Share/src/users/' .$userName . '/A-Level';
            $pathnameGCSE = $_SERVER['DOCUMENT_ROOT'] . '/Study-Share/src/users/' .$userName . '/GCSE';
            console_log($pathnameAlevel);
            console_log($pathnameGCSE);

            if(mkdir($pathnameAlevel,0777,true)){
                console_log("sucessful");
            }
            else{
                console_log("unsucessful file creation for a level");
            }

            if(mkdir($pathnameGCSE,0777,true)){
                console_log("sucessful");
            }
            else{
                console_log("unsucessful file creation for gcse");
            }

            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $userName;
        }

        public function storePost($postTitle,$subject,$ownerID,$eduLevel,$path){
            $sql = "INSERT INTO Posts (ownerID, title, subject, educationLevel, path) VALUES ('$ownerID','$postTitle','$subject','$eduLevel','$path')";
            if(mysqli_query($this->conn,$sql)){
                console_log("post stored");
            }
            else{
                console_log("post not stored");
            };

            $postID = mysqli_insert_id($this->conn);

            $updatedPath = $path . '/' . $postID;

            $sqlUpdatePath = "UPDATE Posts SET path = '$updatedPath'";
            mysqli_query($this->conn,$sqlUpdatePath);
            return $postID;
        }



        //Extra function -----------------------------------------------------------------//
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

        public function LogInOut($InOrOut) {
            if($InOrOut){
                $this->console_log("Logged in!");
                $_SESSION['loggedIn'] = true;
            }
            elseif($InOrOut == false){
                session_start();
                session_unset();
                session_destroy();
                console_log("Logged out");
            }
            else {
                console_log("Login/out error");
            }
        }

        public function getUserID($userName){
            $sql = mysqli_query($this->conn, "SELECT * FROM Accounts WHERE username = '$username'");
            $row = mysqli_fetch_array($sql);
            $userID = $row['userID'];
            return $userID;
        }
    }//end class
?>	