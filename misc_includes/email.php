<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: dprah
 * Date: 5/29/2018
 * Time: 2:25 AM
 */
//Fetch the Active email
$sql_select = <<<HERE
SELECT active_email FROM email WHERE id = 1;
HERE;
try{
    $results=$db->query($sql_select);
    foreach ($results as $row ){
        $mail = $row;
    }
}catch (PDOException $exception){
    exit($exception->getMessage());
}
$email = $mail['active_email'];