<?php
include 'Document.php';
include 'DataInterface.php';
include 'Post.php';

class RegisteredUser{
    private $userid;
    private $userName;
    private $name;
    private $isAdmin;
    private $dataInterfaceObj;

    public function __constructor(){
        $this->dataInterfaceObj = DataInterface::getInstance();
    }

    public function createNewPost($file_name,$file_size,$file_type,$file_tmp,$postTitle,$eduLevel,$subject){
        console_log($eduLevel);
        $fileObj = new Document($file_name,$file_size,$file_type,$file_tmp,$this->userName);
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/Study_Share_v2/src/users/' . $fileObj->getDocumentOwner();
        $targetFile = $targetDir;

        if($eduLevel == "A-Level"){
            $targetFile = $targetFile . '/' . "A-Level";
        }
        else{
            $targetFile = $targetFile . '/' . "GCSE";
        }
        
        //$targetFile = $targetFile.'/'.$fileObj->getFileName();
        $dataInterfaceObj = DataInterface::getInstance();
        $userID = $dataInterfaceObj->getUserID($this->userName);
        $postID = $dataInterfaceObj->storePost($postTitle,$subject,$userID,$eduLevel,$targetFile,$file_name);

        $targetFile = $targetFile .'/' . $postID;

        $postObj = new Post($postID, $userID);
        $postObj->setTitle($postTitle);
        $postObj->setSubject($subject);
        $postObj->setEducationLevel($eduLevel);

        console_log($targetFile);

        $oldmask = umask(0);
        if(mkdir($targetFile,0777,true)){
            console_log("file made");
        }
        else{
            console_log("file not made");
        }
        umask($oldmask);

        $targetFile = $targetFile . '/' . $fileObj->getFileName();
        if(move_uploaded_file($fileObj->getFileTmp(),$targetFile)){
            console_log("sucessful upload");
        }
        else{
            console_log("did not upload");
        }
    
    }

    public function setUserName($value){
        $this->userName = $value;
    }

    public function getUserName(){
        return $this->userName;
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }  
    
    function setPassword($newPass){
        $dataInterfaceObj = DataInterface::getInstance();
        $username = $_SESSION['username'];
        $Query = "UPDATE Accounts SET password='$newPass' WHERE username='$username';";
        $result = $dataInterfaceObj->makeQuery($Query);
        if($result != NULL){
            $this->console_log("Password sucessfully changed");
            return true;
        }
        else{
            $this->console_log("Error with changing password");
            return false;
        }
    }
}
?>