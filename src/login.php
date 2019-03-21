<?php
    session_start();
    include 'Guest.php';

    $guestObj = new Guest;
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    if($guestObj->login($username, $password)) {
        header("Location: ./index.html");
    }
    else {
        header("Location: ./index.html?login=error!");
        exit();
    }
?>