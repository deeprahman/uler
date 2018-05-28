<?php
declare(strict_types=1);
include_once "misc_includes/session_start.php";

use classes\AddEmployee;
use classes\FormCheck;

if (!isset($_POST['submit']) || ($_SESSION['is_admin'] !== 1 && (!isset($_SESSION["id"])))) {
    exit("<br><h1 align='center'>You are not LOGGED IN PROPERLY or SOMETHING IS WRONG!<br> EXIT AND LOGIN.</h1>");
}
// Filtering and Taking the submitted information
foreach ($_POST as $key => $value) {
    if ($value == NULL) {
        include "views/add.html.php";
        exit($key . " is not filled");
    }
    $emp_info[$key] = filter_input(INPUT_POST, $key);
}
//Remove "submit" element from the top
array_pop($emp_info);
//Include PDO class
include "d_connection/database.php";
//instantiate the FormCheck class
include "classes/FormCheck.php";
$check = new FormCheck();
//    Contain information about error in the form
//$error_array = array();
//Minimum Length of the username and password
$min_u_name = 6;
$min_p_word = 8;
//Check if the provided username length is greater than or equal to $min_u_name
if (!$check->checkLength($min_u_name, $emp_info['emp_username'])) {
    $error_array[] = "Username must contain at least 6 characters.";

    $u_name = False; //indicator
}
if (!$check->checkLength($min_p_word, $emp_info['emp_password'])) {
    $error_array[] = "Password must contain at least 8 characters.";

    $p_word = FALSE; //indicator
}
//Only execute, if password and username satisfy the mimimum length.
if (!isset($u_name) && !isset($p_word)) {
//    For checking username
    $table = "login_info";
    $fields = ["user_name"];
    $where_field = "user_name";
    $db_username = $check->checkInDatabase($db, $emp_info["emp_username"], $table, $fields, $where_field);
    if ($db_username) {
        $error_array[] = "Username Already Exists.";

    }
//    For checking user id
    $table = "login_info";
    $fields = ["user_id"];
    $where_field = "user_id";
    $db_use_id = $check->checkInDatabase($db, $emp_info["id"], $table, $fields, $where_field);
    if ($db_use_id) {
        $error_array[] = "User ID Already Exists.";
    }
//    For checking email
    $table = "employee_info";
    $fields = ["email"];
    $where_field = "email";
    $db_email = $check->checkInDatabase($db, $emp_info["email"], $table, $fields, $where_field);
    if ($db_email) {
        $error_array[] = "Email Already Exists.";

    }
}
//Form error handling
if (isset($error_array)) {
    foreach ($error_array as $error) {
        $print = <<<HERE
    <li>{$error}</li>
HERE;
        $message .= $print;
    }
    $_SESSION['status'] = $message;
    header('location:.');
    exit();
}

//Instantiate the AddEmployee class
include "classes/AddEmployee.php";
$add_emplye = new AddEmployee($emp_info, $db);

if (!isset($error_array) && $add_emplye->insert()) {
    $_SESSION['status'] = "Successfully Added an Employee!";
} else {
    $_SESSION['status'] = "Employee could not be added.";
}

header('location:.');





