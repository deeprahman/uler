<?php
if($remember !== NULL){
    // Data for setting cookie
    $cookie_name="remember";
    $cookie_value = $_SESSION['id'].",".$_SESSION['is_admin']; //Neet to taken care in the CookieHandle class.
    $cookie_expire = time()+60*60*24*7;
    $remem_chk->setCookie($cookie_name,$cookie_value,$cookie_expire);
}