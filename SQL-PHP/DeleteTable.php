<?php
    include 'DBConnect.php';

    $sql = "DROP TABLE Accounts";

    if (mysqli_query($con, $sql)) {
        echo "<br/> Record deleted successfully <br/> ";
    } 
    else {
        echo "<br/>  Error deleting record: " . mysqli_error($con) . "<br/> ";
    }

    mysqli_close($con);
?>