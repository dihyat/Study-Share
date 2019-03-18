<?php 
include 'DataInterface.php';

class Guest {
    public function register($email, $username, $password, $firstname, $surename, $userType) {
        $dataInterfaceObj = DataInterface::getInstance();
        $con = $dataInterfaceObj->getConnection();
        if($dataInterfaceObj->storeNewUser($email,$username,$password,$firstname,$surename,$userType)) {
            return TRUE;
        }  
        else {
            return FALSE;
        }

    mysqli_close($con);
    }
    
    public function login($userName, $password) {
        $dataInterfaceObj = DataInterface::getInstance();
    
        //Checks if account exists, true or false
        console_log($dataInterfaceObj->searchUser($userName,$password));
        
        //Implement later
        if(true) {
            return TRUE;
        }
        else{
            return FALSE;
        }

    }
}
?>