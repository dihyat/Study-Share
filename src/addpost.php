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

echo '
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <div class="navbar">
            <ul>
              <li id="logo">Study Share</li>
              <li><a href="./index.php">Home</a></li>
            </ul>
        </div>
        <div class="FormDiv">
            <table class="FormTable" style="margin-left: 30%">
              <tr>
                <td valign="top">
                  <h1>Add Post</h1>
                  <p>Please fill in this form to upload your notes.</p>
                </td> 
  
              </tr>
  
              <tr>
                
                <td valign="top">
                  <hr></hr>
                  <form action="addpost.php" method ="POST" enctype="multipart/form-data" class="formbody" >
                    <table>
                      <tr><td valign="top" class="TextBoxPart">
                        <p>
                          <label><b>Title</b></label>
                        </p>
                        <input type="text" placeholder="Enter title" name="title" required>
  
                        <p>
                          <label><b>Education Level</b></label>
                        </p>
                        <select class="Dropdown" name="eduLevel" placeholder="A-Levels" required>
                          <option value="A-Level">A-Levels</option>
                          <option value="GCSE">GCSE</option>
                        </select>
  
                        <p>
                          <label><b>Subject</b></label>
                        </p>
                        <select class="Dropdown" name="subject" placeholder="Mathematics" required>
                            <option value="maths">Mathematics</option>
                            <option value="physics">Physics</option>
                            <option value="chemistry">Chemistry</option>
                          </select>
  
                        <p>
                            <label><b>Upload File</b></label>
                        </p>
                        <input type="file" name="fileToUpload" id="fileToUpload">
  
                      <tr><td valign="bottom">
                        <input class="btn" type="submit" id="signupbtn" name="submit" value="Submit"/>
                      </td></tr>
  
                      </table>
                    </form>
                </td>
                </tr>
                </table>
                </div>
    </body>
</html>'
?>