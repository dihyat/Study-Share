<?php
session_start();
//$_SESSION['loggedIn'] = "a";
echo "test";
echo $_SESSION['loggedIn'];
  if(isset($_SESSION['loggedIn']) == false){
    //header("location: index.php");
    $Hi = isset($_SESSION['loggedIn']);
    echo $Hi;
    echo "Test 2";
  }
?>

<!DOCTYPE html>
<html>

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
          <li><a href="./index.html">Home</a></li>  
          <li id="LoginButton" style="float:right"><button class="btn" name="login" id="loginbtn">logout</button></li>
          <li id="Uploadbtn" style="float:right"></li>
        </ul>
      </div>
    </form>

<!-- <div id="background" style="background-color:#F3F2F2;">
  <div id="mainPanel" style="width:500px; height:100%; margin:auto; background-color:white;" >
    <h2 style="text-align:center">YOUR ACCOUNT</h2>
    <img src="DefaultProfilePic.png" alt="USER PROFILE PIC" align="middle" style="width:100%; height:100%; margin:auto; ">
<div class="card">
  
  <h1 style="text-align:center">John Smith</h1>

  <table height=200px width=100% style="font-size:20px;">
    <h1>
      <tr>
        <td><b>User ID:</b></td>
        <td>13872</td>
      </tr>
      <tr>
        <td><b>Username:</b></td>
        <td>JohnS99</td>
      </tr>
      <tr>
        <td><b>Name:</b></td>
        <td>John Smith</td>
      </tr>
      <tr>
        <td><b>Admin Status:</b></td>
        <td>User is Admin</td>
      </tr>
    </h1>
  </table>
  </div>
</div>
</div> -->
  </body>
</html>
