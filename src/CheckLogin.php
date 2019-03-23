<?php
    session_start();
    if(isset($_SESSION['loggedIn']) == false){
        header("location: index.php");
    }
    else {
        $username = $_SESSION['username'];
        $userType = $_SESSION['userType'];
        $firstname = $_SESSION['firstname'];
        $lastname = $_SESSION['lastname'];
        $email = $_SESSION['email'];
    }
?>