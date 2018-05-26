<?php

namespace classes;
/**
 * Class RetrieveEmailInfo
 * @package classes
 */
class RetrieveEmailInfo
{
    protected $db;

    public function __construct(object &$pdo)
    {
        $this->db =& $pdo;
    }

//    Retreive the employee info
    public function retrieveInfo(string $table, array $fields, string $user_id)
    {
        $comma_sep_field = implode(",", $fields);
        $sql = "SELECT {$comma_sep_field} FROM {$table} WHERE id = {$user_id}";
        try {
            $results = $this->db->query($sql);
            foreach ($results as $result) {
                $emp_info = $result;
            }
        } catch (\PDOException $exception) {
            exit($exception->getMessage());
        }
        return $emp_info;
    }


}