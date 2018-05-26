<?php
declare(strict_types = 1);
include_once "misc_includes/session_start.php";
use classes\TimeStamp;
use classes\RetrieveEmailInfo;
//If not an employee and session id is not set, show the message
if (($_SESSION['is_admin']!==0 && (!isset($_SESSION["id"])))) {
    exit("<br><h1 align='center'>You are not LOGGED IN PROPERLY or SOMETHING WENT WRONG!<br> EXIT AND LOGIN.</h1>");
}
//include the database script
include "d_connection/database.php";
// include the timestamp and RetrieveEmailIno class
include "classes/TimeStamp.php";
include "classes/RetrieveEmailInfo.php";
//Create a new instance of TimeStamp
$arvl = new TimeStamp();
//If the arraival Button is clicked, Send email
if (isset($_POST['arrival'])){
    $arvl->setTime($_SESSION['id'],"employee_arrival","arrival",$db);
    $arrive=$arvl->getTime($_SESSION['id'],'employee_arrival',"arrival",$db);
    $_SESSION['msg'] = "Arrival Timestamp:  {$arrive}";
//    Create a new instance of RetrieveEmailInfo
    $ret_v = new RetrieveEmailInfo($db);
//    Define variables for retrieve info
    $table ="employee_info";
    $fields =[
        "name_first",
        "name_mid",
        "name_last",
        "designation"
    ];
//    reteieve info for sending email
    $emp_info = $ret_v->retrieveInfo($table,$fields,$_SESSION['id']);
    $name_f = $emp_info['name_first'];
    $name_m = $emp_info['name_mid'];
    $name_l = $emp_info['name_last'];
    $des = $emp_info['designation'];
//    retrieve the admin email address
    try{
        $sql = "SELECT admin_email FROM admin WHERE id = 1";
        $result = $db->query($sql);
        foreach ($result as $item){$email_array = $item;}
    }catch (PDOException $exception){

    }
//    Email address
    $to = $email_array['admin_email'];
//    Subject
    $subject ="Arrival Timestamp of {$name_f} {$name_m} {$name_l}";
//    Message
    $message = "Employee name: {$name_f} {$name_m} {$name_l}, <br>Employee Designation: {$des},<br>Employee ID: {$_SESSION['id']}<br>
 arrived at {$arrive} .";
//    Send Email
    if (mail($to,$subject,$message)){
        header("location:.");
    }else{
        echo "Mail was not sent.";
    }
    exit();
}













