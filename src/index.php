<?php 
include 'RegisteredUser.php';

session_start();
console_log($_SESSION);
$loginbtn;
$registeredUserObj;
if($_SESSION['logged_in'] == true){
  $loginbtn = '<li style="float:right"><button class="btn" name="logout">Logout</button></li>';
  $registeredUserObj = new RegisteredUser;
  $registeredUserObj->setUserName($_SESSION['userName']);
  $_SESSION['registeredUser'] = $registeredUserObj;
}
else{
  $loginbtn = '<li style="float:right"><button class="btn" name="login">Login/SignUp</button></li>'; //if not logged in
}

if(isset($_POST['logout'])){
  $_SESSION['logged_in'] = false;
  $_SESSION['userName'] = false;
  $_SESSION['registeredUser'] = false;
  $loginbtn = '<li style="float:right"><button class="btn" name="login">Login/SignUp</button></li>';
}

if(isset($_POST['login'])){
  header("location: login.php");
}

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

echo '<!DOCTYPE html>
<html class="no-js">
  <!--<![endif]-->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Study Share</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./main.css" />
  </head>

  <body>
  <form action="index.php" method="post">
    <div class="navbar">
      <ul>
        <li id="logo">Study Share</li>
        <li><a href="#home">Home</a></li>'; print($loginbtn); echo '
      </ul>
    </div>
    </form>

    <div class="ques">
      <p class="">Select Education Level To Begin</p>
    </div>

    <div>
      <a href="addpost.php"><button class="button" style="margin-left : 30%">A-Levels</button></a>
      <a href="addpost.php"><button class="button" style="margin-left : 55%; padding-left: 45px; padding-right: 45px ">
        GCSE
      </button></a>
    </div>

    <script src="" async defer></script>
  </body>
</html>'
?>
