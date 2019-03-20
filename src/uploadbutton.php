<?php 
include 'Document.php';
//include 'RegisteredUser.php';

if(isset($_FILES['uploadfile']))
{
    $file_name = $_FILES['uploadfile']['name'];
    $file_size = $_FILES['uploadfile']['size'];
    $file_type = $_FILES['uploadfile']['type'];
    $file_tmp = $_FILES['uploadfile']['tmp_name'];
    $postTitle = $_POST['postTitle'];
    $subject = $_POST['subject'];

    upload($file_name,$file_size,$file_type,$file_tmp, $postTitle,$subject);
}

function upload($file_name,$file_size,$file_type,$file_tmp,$postTitle,$subject){
    $userName = "johniscool";
    /*
    console_log($file_name);
    console_log($file_size);
    console_log($file_type);
    console_log($file_tmp);
    console_log($postTitle);
    console_log($subject);
    */
    

    $fileObj = new Document($file_name,$file_size,$file_type,$file_tmp,$postTitle,$subject,$userName);

    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/Study-Share/src/users/' . $fileObj->getUserName();
    console_log($targetDir);
    $targetFile = $targetDir.'/'.$fileObj->getFileName();
    console_log($targetFile);

    if($fileObj->getSubject() == "alevel"){
        $targetFile = $targetFile . "a-level";
    }
    else{
        $targetFile = $targetFile . "gcse";
    }

    $targetFile = $targetFile.'

    mkdir($targetFile, 0777);

    if(move_uploaded_file($fileObj->file_tmp,$targetFile)){
        console_log("sucessful");
    }
    else{
        console_log("unsucessful");
    }
}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

echo'<html>
    <body>
        <form action="uploadbutton.php" method ="POST" enctype="multipart/form-data">
            <input type="text" name="postTitle" placeholder="title">
            <input type="text" name="subject" placeholder="subject">
            <input type="file" name="uploadfile">
            <input type="submit" value="Submit">
        </form>
</html>'
?>