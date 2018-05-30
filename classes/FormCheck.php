<?php
/**
 * Created by PhpStorm.
 * User: dprah
 * Date: 5/27/2018
 * Time: 6:27 PM
 */
namespace classes;
/**
 * Class FormCheck
 * @package classes
 */
class FormCheck
{
    /**
     * Check and compare the length of a string
     * string length > minlength returns true
     * @param int $minlenth
     * @param string $string
     * @return bool
     */
    public function checkLength(int &$minlenth, string &$string): bool
    {
        $length = strlen($string);
        if ($length >= $minlenth) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Returns true, if the string exists in the database
     * @param object $pdo
     * @param string $string
     * @param string $table
     * @param string $field
     * @return bool
     */
    public function checkInDatabase(object &$pdo, string &$string, string $table, array $fields,string &$where_field): bool
    {
        $fields = implode(',',$fields);
        $sqlSelect = <<<HERE
SELECT {$fields} FROM {$table} WHERE {$where_field} = "{$string}"
HERE;
        try {
            $result = $pdo->query($sqlSelect);
        } catch (\PDOException $exception) {
            exit($exception->getMessage());
        }
        if ($result->fetch()) {
            return TRUE;
        }
        return False;
    }
    /**
     * Validate an Email address
     * @param string $email
     * @return bool
     */
    public function validateEmail(string &$email_a):bool
    {
       if (filter_var($email_a,FILTER_VALIDATE_EMAIL)){
           return TRUE;
       }
       return FALSE;
    }
}