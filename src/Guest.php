<?php 
include 'DataInterface.php';

class Guest {
    public function register($email, $username, $password, $firstname, $surename, $userType, $rePassword) {
        $dataInterfaceObj = DataInterface::getInstance();
        $con = $dataInterfaceObj->getConnection();
        return $dataInterfaceObj->storeNewUser($email,$username,$password,$firstname,$surename,$userType, $rePassword); 
        mysqli_close($con);
    }
    
    public function login($userName, $password) {
        $dataInterfaceObj = DataInterface::getInstance();
    
        //Checks if account exists, true or false
        $LoginResults = $dataInterfaceObj->searchUser($userName,$password);
        return  $LoginResults;

    }
}
?>