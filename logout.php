<?php
declare(strict_types = 1);
include_once "misc_includes/session_start.php";
include_once "classes/CookieHandle.php";
if (isset($_COOKIE['remember'])) {
    unset($_SESSION['id']);
    unset($_SESSION['is_admin']);
    if (
    setcookie("remember", "", time()-11111)
    ) {session_destroy();}

}else{
    session_destroy();
}
header("location:.");
