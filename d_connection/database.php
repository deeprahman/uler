<?php
/**
 * Connect to the database
 */


//Include the database config script.
include "config/database.conf.php";

//Using PDO to establish connection
try{
    $db = new PDO(THIS_DBINFO,THIS_USER_NAME,THIS_USER_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $db_ok=1;
}catch (PDOException $exception){
    exit("connection could not be established!");
}
