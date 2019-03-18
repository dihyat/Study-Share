<?php
    include 'Guest.php';

    $guestObj = new Guest;
    $username = $_POST['username'];
    $password = $_POST['psw'];

    if($guestObj->login($userName, $password)) {
        //redirect if true
        return;
    }
?>

<!--Else new HTML page with error message!-->