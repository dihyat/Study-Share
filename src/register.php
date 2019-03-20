<?php
    include 'Guest.php';
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['psw'];
    $firstname = $_POST['fname'];
    $surename = $_POST['sname'];
    $userType = $_POST['userType'];

    $guestObj = new Guest;
    $RegResults = $guestObj->register($email, $username, $password, $firstname, $surename, $userType);
    if ($RegResults == False) {
        echo "User Exists";
    }

    /*
     echo $_POST['email'];

    $sql = "INSERT INTO userdata VALUES" . "(" .
        strval($_POST['email']) . "," . 
        strval($_POST['username']) . "," . 
        strval($_POST['pwd']) . 
    ");";
    
    if(mysqli_query($con, $sql)) {
        echo "<br/> User Created <br/>";
    } 
    else {
        echo "<br/> Error creating Entry: " . mysqli_error($con) . "<br/>";
    }

    mysqli_close($con);
    */
?>