<?php
    session_start();
    include 'Guest.php';

    if(isset($_SESSION['loggedIn'])){
        header("Location: ./index.php");
    } 

    $guestObj = new Guest;
    if (!empty($_POST)) {
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];


        if($guestObj->login($username, $password)) {
            header("Location: index.php");
        }
        else{
            $_SESSION['AttemptMade'] = true;
        }
    }

    include_once 'login.html';
    if(isset($_SESSION['AttemptMade'])){
        echo "<script>
            var ErrorSection = document.getElementById('loginError');
            ErrorSection.innerHTML += 'Error: Incorrect username/password inputed';
            ErrorSection.style.color = 'red';
            document.getElementById('loginUsername').value = '$username';
            document.getElementById('loginPassword').value = '$password';
        </script>";
    }
?>