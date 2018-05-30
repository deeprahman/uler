<?php
/**
 * Created by PhpStorm.
 * User: dprah
 * Date: 5/28/2018
 * Time: 10:38 PM
 */
declare(strict_types=1);

use classes\Auth;

include "classes/Auth.php";
include "d_connection/database.php";


//Add Admin**********************************************************************
if (isset($_POST['n_submit']) && ($_POST['n_name'] != NULL) && ($_POST['n_pass'] != NULL)) { //Submit button is clicked
//    Take the information
    $n_name = filter_input(INPUT_POST, 'n_name');
    $n_pass = filter_input(INPUT_POST, 'n_pass');
    $n_conf = filter_input(INPUT_POST, 'n_conf');
//   procedure for Adding new admin
    if ($n_pass !== $n_conf) {
        exit("Passwords are not a match");
    }
    //hash password
    $n_pass = password_hash($n_pass, PASSWORD_DEFAULT);
    $sql_insert = <<<HERE
INSERT INTO admin(admin_user, admin_pass, entry_date) VALUES(:name,:pass,now());
HERE;
    try {
        $prepared = $db->prepare($sql_insert);
        $prepared->bindValue(":name", $n_name);
        $prepared->bindValue(":pass", $n_pass);
        $prepared->execute();
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
    $setting_mess = <<<HERE
New Administrator Added!
HERE;
    echo "<h1 align='center' style='margin: auto; border: 1px solid gainsboro;width:500px;margin-top: 100px;'>{$setting_mess}</h1>";
    exit();
}

//Delete Admin***********************************************************************
if (isset($_POST['e_submit']) && ($_POST['e_name'] != NULL) && ($_POST['e_pass'] != NULL)) { //Submit button is clicked
//    Take the information
    $e_name = filter_input(INPUT_POST, 'e_name');
    $e_pass = filter_input(INPUT_POST, 'e_pass');
    $e_conf = filter_input(INPUT_POST, 'e_conf');
//  Procedure for  Deleting the Admin
    $hass_pass = password_hash($e_pass, PASSWORD_DEFAULT);
//    Check for provided information exists in the database
    $sql_select = <<<HERE
SELECT admin_user,admin_pass FROM admin WHERE admin_user=:user
HERE;
    $sql_delete = <<<HERE
DELETE FROM admin WHERE admin_user = :user
HERE;

    try {
//        Confirming the entered values are valid
        $prepared = $db->prepare($sql_select);
        $prepared->bindValue(":user", $e_name);
         $prepared->execute();
         $result=$prepared->fetchAll();
        foreach ($result as $row) {
            $username = $row['admin_user'];
            $password_hash = $row['admin_pass'];
        }
        if (password_verify($e_pass, $password_hash)) {
//            Deleting the Admin
            $prepared = $db->prepare($sql_delete);
            $prepared->bindValue(":user", $e_name);
            $prepared->execute();
            if ($prepared->rowCount() === 0) {
                exit("Some thing was gone wrong, Admin could not be deleted!");
            }
        }
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
    $setting_mess = <<<HERE
Admin Deleted!
HERE;
    echo "<h1 align='center' style='margin: auto; border: 1px solid gainsboro;width:500px;margin-top: 100px;'>{$setting_mess}</h1>";
}
header("location:.");
//Active Email**************************************************************
if (isset($_POST['email_submit']) && ($_POST['new_email'] != NULL) && ($_POST['conf_email'] != NULL)) { //Submit button is clicked
//    Take the information
    $new_email = filter_input(INPUT_POST, 'new_email');
    $conf_email = filter_input(INPUT_POST, 'conf_email');
//    Procedure for Updating existing email address
    if ($conf_email !== $new_email) {
        exit("Email does not match");
    }

    $sql_update = <<<here
UPDATE email SET active_email =:email WHERE id=1;
here;
    try {
        $prepared = $db->prepare($sql_update);
        $prepared->bindValue(":email", $conf_email);
        $prepared->execute();
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
    $setting_mess = <<<HERE
Email Address Updated!
HERE;
    echo "<h1 align='center' style='margin: auto; border: 1px solid gainsboro;width:500px;margin-top: 100px;'>{$setting_mess}</h1>";

}

