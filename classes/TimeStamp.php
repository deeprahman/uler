<?php

namespace classes;
/**
 * Class TimeStamp
 * @package classes
 * setTime(): Sets a DATETIME in the database by employee ID; input: user ID nad PHP Data Object.
 * getTime(): Gets the latest DATETIME by employee ID from the database.
 */
class TimeStamp
{
    public function setTime(int $user_id,string $table,string $field, object $db)
    {
        $sql = "INSERT INTO {$table} SET {$field} = now(), user_id = {$user_id}";

        try {
            $affected_row = $db->query($sql);
        } catch (\PDOException $exception) {
            $_SESSION['msg'] = "Something went wrong while inserting Date-Time. Details: " . $exception->getMessage();
        }
        return $affected_row;
    }

    public function getTime(int $user_id,string $table,string $field, object $db)
    {
        $sql = "select {$field} FROM {$table} 
WHERE user_id ={$user_id} AND id =(SELECT MAX(id) FROM {$table} WHERE user_id = {$user_id})";

        try {
            $affected_row = $db->query($sql);
            foreach ($affected_row as $key=> $value){ $val = $value;}
        } catch (\PDOException $exception) {
            $_SESSION['msg'] = "Something went wrong while retrieving Date-Time. Details: " . $exception->getMessage();
        }
        return $val[$field];
    }


}