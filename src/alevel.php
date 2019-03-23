<?php
include 'DataInterface.php';

$dataInterfaceObj = DataInterface::getInstance();
$posts = $dataInterfaceObj->getALevelPosts();

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
    <title></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="main.css" />
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li id="logo">Study Share</li>
        <li><a href="./index.html">Home</a></li>
        <li style="float:right"><a href="./login.html">Login/SignUp</a></li>
        <li style="float:right"><a href="./addpost.html">Upload Notes</a></li>
      </ul>
    </div>Alegbra
    upvote stuff
    View Post
    <div class="edutitle">
      <p>GCSE</p>
    </div>
    <div class="subBody"></div>

    <!--div class="card">
      <div class="cardcontainer">
        <a href="">Maths</a>
      </div>
    </div-->

    <div class="ques">
      <p class="">A Level posts</p>
    </div>
';

echo '
    <div class="UserPageDiv" style="padding-top: 20px;">';
    while($rows = mysqli_fetch_array($posts)) {
        echo'<div class="large-grid-item"><table><tr><td>'.$rows["title"].'</td></tr>
        <tr><td>upvote stuff</td></tr>
        <tr><td>';
        echo '<a href="download.php?file='.$rows["path"].'">Download Notes here</a>';
        echo '</td></tr></table></div>';

    }

  echo '</body></html>';
//include_once 'gcse.html';