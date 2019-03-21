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
    }

    include_once 'login.html';
    echo "<script>
        var ErrorSection = document.getElementById('loginError');
        ErrorSection.innerHTML += 'Error: Incorrect username/password inputed';
        ErrorSection.style.color = 'red';
    </script>";
?>