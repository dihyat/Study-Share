<?php
include 'RegisteredUser.php';
session_start();
if($_SESSION['logged_in'] == false){
  echo '<script language="javascript">';
  echo 'alert("Before you can upload notes, you need to login!");';
  echo "window.location.replace('login.php')";
  echo '</script>';
  
}

if(isset($_FILES['fileToUpload']))
{
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    
    $postTitle = $_POST['title'];
    $eduLevel = $_POST['eduLevel'];
    $subject = $_POST['subject'];

    upload($file_name,$file_size,$file_type,$file_tmp, $postTitle,$eduLevel,$subject);
}

function upload($file_name,$file_size,$file_type,$file_tmp,$postTitle,$eduLevel,$subject){
    $userName = $_SESSION['userName'];
    $registeredUserObj = $_SESSION['registeredUser'];
    $registeredUserObj->createNewPost($file_name,$file_size,$file_type,$file_tmp,$postTitle,$eduLevel,$subject);

}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

  include_once 'addpost.html';
?>