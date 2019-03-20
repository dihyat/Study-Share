<?php 
include 'DataInterface.php';

class Guest {
    public function register($email,$userName,$name,$password){
        $dataInterfaceObj = DataInterface::getInstance();
        $dataInterfaceObj->storeNewUser($email,$userName,$name,$password);
        
    }
    
    public function login($userName, $password){
        $dataInterfaceObj = DataInterface::getInstance();
    
        //Checks if account exists, true or false
        return $dataInterfaceObj->searchUser($userName,$password);
        
    }
}

?>