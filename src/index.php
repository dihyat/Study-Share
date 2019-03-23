<?php 
include 'RegisteredUser.php';

session_start();
console_log($_SESSION);
$loginbtn;
$uploadBtn;
$UserIcon;
$registeredUserObj;

if(isset($_POST['logout'])){
  session_unset();
  session_destroy();
  $loginbtn = '<button class="btn" name="login" id="loginbtn" style="width:250px;">Login/SignUp</button>';
  $UserIcon = '';
  $uploadBtn = "<a></a>"; 
  
  $_POST['logout'] = false;
  console_log("Loggin button selected");
}

if(isset($_SESSION['loggedIn'])){ 
  $loginbtn = '<button class="btn" name="logout" id="logoutbtn" style="width:250px;">logout</button>';
  $UserIcon = '<a style="padding:3px;" href="./UserPage.php"><img src="UserIcon.png" width="50" height="50"/></a>';
  //<button class="btn" name="login" id="loginbtn" style="width:250px;">Login/SignUp</button>';
  $registeredUserObj = new RegisteredUser;
  $registeredUserObj->setUserName($_SESSION['username']);
  $_SESSION['registeredUser'] = $registeredUserObj;
  $uploadBtn = "<a href=addpost.html>Upload Notes</a>"; 
  console_log("Logged out button selected");

include_once 'index.html';
 echo "<script>
    document.getElementById('loginbtn').remove;
    document.getElementById('LoginButton').innerHTML='$loginbtn';
    document.getElementById('Uploadbtn').innerHTML='$uploadBtn';
    document.getElementById('UserPageIcon').innerHTML='$UserIcon';
  </script>";
}
else{
  $loginbtn = '<button class="btn" name="login" id="loginbtn" style="width:250px;">Login/SignUp</button>';
  $UserIcon = '';
  $uploadBtn = "<a></a>"; 
}

if(isset($_POST['login']) && (isset($_SESSION['loggedIn'])==false)){
  header("location: login.php");
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}
  
include_once 'index.html';
/*
if(isset($_SESSION['loggedIn'])){
  echo "<script>
    document.getElementById('loginbtn').remove;
    document.getElementById('LoginButton').innerHTML='$loginbtn';
    document.getElementById('Uploadbtn').innerHTML='$uploadBtn';
  </script>";
}
*/
?>
