<?php
    session_start();
    include 'Guest.php';

    $guestObj = new Guest;
    if (!empty($_POST)) {
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];


        if($guestObj->login($username, $password)) {
            header("Location: ./index.php");
        }
        else {
            header("Location: ./index.html?login=error!");
            exit();
        }
    }

    include_once 'login.html';
?>