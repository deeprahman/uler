<?php
declare(strict_types = 1);
include_once "misc_includes/session_start.php";
if (($_SESSION['is_admin']!==0 && (!isset($_SESSION["id"])))) {
    exit("<br><h1 align='center'>You are not LOGGED IN PROPERLY or SOMETHING IS WRONG!<br> EXIT AND LOGIN.</h1>");
}
if (isset($_GET['img'])){
    $_SESSION['img'] = "img";
}
header("location:..");