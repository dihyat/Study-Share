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
        console_log("works");
        $fileObj = new Document($file_name,$file_size,$file_type,$file_tmp,$userName);

    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/Study-Share/src/users/' . $fileObj->getDocumentOwner();
    $targetFile = $targetDir;

    if($eduLevel == "A-Level"){
        $targetFile = $targetFile . '/' . "A-Level";
    }
    else{
        $targetFile = $targetFile . '/' . "GCSE";
    }
    
    //$targetFile = $targetFile.'/'.$fileObj->getFileName();
    $dataInterfaceObj = DataInterface::getInstance();
    $userID = $dataInterfaceObj->getUserID($userName);
    $postID = $dataInterfaceObj->storePost($postTitle,$subject,$userID,$eduLevel,$targetFile);

    $targetFile = $targetFile .'/' . $postID;

    $postObj = new Post($postID, $userID);
    $postObj->setTitle($postTitle);
    $postObj->setSubject($subject);
    $postObj->setEducationLevel($eduLevel);

    console_log($targetFile);

    $oldmask = umask(0);
    if(mkdir($targetFile, 0777)){
      console_log("file made");
    }
    else{
      console_log("file not made");
    }
    umask($oldmask);

    $targetFile = $targetFile . '/' . $fileObj->getFileName();
    if(move_uploaded_file($fileObj->getFileTmp(),$targetFile)){
        console_log("sucessful");
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
}
?>