<?php
    $host   =   "localhost:3306"  ;
    $user   =   "root"  ;
    $pass   =   ""  ;
    $mydb = "studysharedb1";

    /*$db = new mysqli($host, $user, $pass, $mydb) or die(" > DBConnect.php error => Could not connect");*/
    $con = mysqli_connect($host, $user, $pass, $mydb) or die(" > DBConnect.php error => Could not connect");
    echo  '<br/> Successfully selected database' ; 
     
/*
    $host   =   "dbprojects.eecs.qmul.ac.uk"  ;
    $user   =   "rr309"  ;
    $pass   =   "ZSG6VdknWBNXk"  ;
    $db   =   "rr309"  ;
     
    $link  =  mysql_connect ( $host ,  $user ,  $pass );
    if (! $link ) {
        die( 'CreateTable.php => Could not connect: '  .  mysql_error ());
    }
    echo  'Connected successfully' ;
    
    $db_selected  =  mysql_select_db ( $db ,  $link );
    if (! $db_selected ) {
        die ( 'CreateTable.php => Can\'t use $db : '  .  mysql_error ());
    }    

    echo  '<br/> successfully selected database' ;

    $link  =  mysql_connect ( $host ,  $user ,  $pass );
    if (! $link ) {
        die( 'CreateTable.php => Could not connect: '  .  mysql_error ());
    }
    echo  'Connected successfully' ;
    
    $db_selected  =  mysql_select_db ( $db ,  $link );
    if (! $db_selected ) {
        die ( 'CreateTable.php => Can\'t use $db : '  .  mysql_error ());
    }    

    echo  '<br/> successfully selected database' ; 
*/
?>