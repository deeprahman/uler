<?php
declare(strict_types=1);
include_once "misc_includes/session_start.php";

//include the namespace
use classes\Auth;
use classes\CookieHandle;

include "classes/Auth.php";
include "d_connection/database.php";
include "classes/CookieHandle.php";

if (
    ($_POST['username'] == NULL) || ($_POST['password'] == NULL)
) {
    header("location:.");
    exit();
}
//Take the input
$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
$is_admin = (int)filter_input(INPUT_POST, "is_admin");
$remember = filter_input(INPUT_POST, "remember");
//Instantiate the Auth class
$log_in = new Auth($db, $username, $password);

// instatiate the cookie handle class
$remem_chk = new CookieHandle();
switch ($is_admin) {
//    User is not admin
    case 0:
        {
            // check if the login information is correct
            if ($log_in->checkEmployee()) {
                $_SESSION['is_admin'] = $is_admin;
                $_SESSION["id"] = $log_in->checkEmployee()['id'];//This is redudant
                $_SESSION['msg'] = "Employee Logged in!";
                // Set the cookie if the remember box is checked
                include "misc_includes/cookievariables.php";
                header("location:.");
                exit();
            } else {
                $_SESSION['msg'] = "Employee could not be authenticated";
                header("location:.");
                exit();
            }
            break;
        }
//    User is admin
    case 1:
        {
            // check if the login information is correct
            if ($log_in->checkAdmin()) {
                $_SESSION['is_admin'] = $is_admin;
                $_SESSION["id"] = $log_in->checkAdmin()['id'];//This is redudant
                $_SESSION['msg'] = "Admin Logged IN";

                // Set the cookie if the remember box is checked
                include "misc_includes/cookievariables.php";
                header("location:.");
                exit();
            } else {
                $_SESSION['msg'] = "Admin could not be authenticated";
                header("location:.");
            }
            break;
        }
}
