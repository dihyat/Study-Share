<?php
    include 'DBConnect.php';

    //Creates UserData table
    $sql = "CREATE TABLE UserData (
        email VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL PRIMARY KEY,
        password VARCHAR(50) NOT NULL,
        firstname VARCHAR(50) NOT NULL,
        surename VARCHAR(50) NOT NULL,
        userType ENUM('Admin', 'Teacher', 'Student') NOT NULL 
        )";
        
    //Messages for if it does/doesn't exist
    if (mysqli_query($con, $sql)) {
        echo "<br/>Table 'UserData' created successfully <br/>";
    } 
    else {
        echo "<br/> Error creating table: " . mysqli_error($con) . "<br/>";
    }

    mysqli_close($con);
?>