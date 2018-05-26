<?php
declare(strict_types = 1);
//Include the session variable
include_once "misc_includes/session_start.php";
include_once "d_connection/database.php";
use classes\CookieHandle;
include_once "classes/CookieHandle.php";
//Is cookie set for an employee
if(isset($_COOKIE['remember'])){
    $cookie = $_COOKIE['remember'];
    $table = "employee_info";
    $fields = ['id'];
    $remem_chk = new CookieHandle();
    $test_cookie = $remem_chk->checkCookie($db,$cookie,$table,$fields);
//    is the cookie set for an admin
    if(!$test_cookie){
        $cookie = $_COOKIE['remember'];
        $table = "admin";
        $fields = ['id'];
        $remem_chk = new CookieHandle();
        $test_cookie = $remem_chk->checkCookie($db,$cookie,$table,$fields);
        if(!$test_cookie){
            $remem_chk->signOut("remember");
            exit();
        }
    }
}

//Arrival link is clicked, session is employee, go to the arrival page
if (isset($_GET['arrival-page']) && $_SESSION['is_admin'] === 0) {
    include "views/arrival.html.php";
    exit();
//    Arrival link is clicked, session is not employee
} else if (isset($_GET['arrival-page']) && $_SESSION['is_admin'] !== 0) {
    $message = "To go to the Arrival/Departure page<br><em>Log in as an Employee</em>";
//    Upload link is clicked, session is admin, go to the Photo upload page
} else if (isset($_GET['upload-page']) && $_SESSION['is_admin'] === 0) {
    include "views/upload.html.php";
    exit();
//    Upload link is clicked, session is not admin
} else if (isset($_GET['upload-page']) && $_SESSION['is_admin'] !== 0) {
    $message = "To go to the Upload page<br><em>Log in as an Employee</em>";
}
//Logged in as admin: go to the Add New Employee page
if ($_SESSION['is_admin'] === 1 && isset($_SESSION['msg']) && !isset($_GET['setting-page']) && !isset($_GET['list-page'])&& !isset($_GET['add-page'])) {
    include "views/add.html.php";
    exit();
//    Logged in as admin: go to the settings page
} elseif ($_SESSION['is_admin'] === 1 && isset($_GET['setting-page'])) {
    include "views/settings.html.php";
    exit();
//    Logged in as admin: go back to the add employee page
} elseif (($_SESSION['is_admin'] === 1 && isset($_GET['add-page']))) {
    include "views/add.html.php";
    exit();
//    Logged in as admin: go to the settings page
}elseif (($_SESSION['is_admin'] === 1 && isset($_GET['list-page']))){
    include "views/list.html.php";
    exit();
}elseif (($_SESSION['is_admin'] !== 1 && isset($_GET['add-page']))){
    $message = "To go to the Add Employee page <br><em>Log in as an Administrator</em>";
}elseif ($_SESSION['is_admin'] !== 1 && isset($_GET['setting-page'])){
    $message = "To go to the Setting Page <br><em>Log in as an Administrator</em>";
}elseif ($_SESSION['is_admin'] !== 1 && isset($_GET['list-page'])){
    $message = "To go to the  Employee List  page <br><em>Log in as an Administrator</em>";
}

//Logged in as an Employee: go to the Arrival Page
if ($_SESSION['is_admin'] === 0 && isset($_SESSION['msg'])) {
    include "views/arrival.html.php";
    exit();
}

//The Home Page
include "views/login.html.php";
