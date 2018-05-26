<?php
include_once "misc_includes/session_start.php";
use classes\AddEmployee;

if (!isset($_POST['submit']) || ($_SESSION['is_admin']!==1 && (!isset($_SESSION["id"])))) {
    exit("<br><h1 align='center'>You are not LOGGED IN PROPERLY or SOMETHING IS WRONG!<br> EXIT AND LOGIN.</h1>");
}
// Filtering and Taking the submitted information
foreach ($_POST as $key => $value){
    if ($value == NULL){
        include "views/add.html.php";
        exit();
    }
    $emp_info[$key] = filter_input(INPUT_POST,$key);
}
//Remove "submit" element from the top
array_pop($emp_info);
//Include PDO class
include "d_connection/database.php";
//Instantiate the AddEmployee class
include "classes/AddEmployee.php";
$add_emplye = new AddEmployee($emp_info,$db);

if ($add_emplye->insert()){
    $_SESSION['msg'] = "Successfully Added an Employee!";
}else{
    $_SESSION['msg'] = "Employee could not be added.";
}
header('location:.');





