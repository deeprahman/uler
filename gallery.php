<?php
/**
 * Created by PhpStorm.
 * User: dprah
 * Date: 5/27/2018
 * Time: 2:51 AM
 */
//SQL query for searching images by id and sorting descendign order
$sql_select = <<<HERE
SELECT * FROM photo_upload WHERE user_id = {$_SESSION['id']} ORDER BY upload_epoch DESC
HERE;
try{
     $results = $db->query($sql_select);
}catch (PDOException $exception){
    exit($exception->getMessage());
}
