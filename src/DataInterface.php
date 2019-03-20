<?php
    class DataInterface {
        private static $DInstance = null;
        private $servername = "localhost";
        private $dbuser = "root";
        private $dbpassword = "password";
        private $dbname = "Study-Share";
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
            $_SESSION['logged_in'] = true;
            $_SESSION['userName'] = $userName;
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

        public function getUserID($userName){
            $sql = mysqli_query($this->conn, "SELECT * FROM Accounts WHERE userName = '$userName'");
            $row = mysqli_fetch_array($sql);
            $userID = $row['userID'];
            return $userID;
        }

        public static function getInstance(){
            if (self::$DInstance == null){
                self::$DInstance = new DataInterface();
            }
            return self::$DInstance;
        }

    }
?>