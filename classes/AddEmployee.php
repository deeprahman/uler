<?php

namespace classes;


class AddEmployee
{
    protected $emp;
    protected $db;

    public function __construct(array &$emp, object &$pdo)
    {
        $this->db =& $pdo;
        $this->emp = $emp;
//        hash the password using PASSWORD_ARGON2I algorithm (PHP >= 7.2.0)
        $this->emp['emp_password'] = password_hash($this->emp['emp_password'], PASSWORD_DEFAULT);
    }

//    Insert into the database
    public function insert(): bool
    {
//        Set a return value
        $return_value = TRUE;

//        The SQL statement
        $sql_info = "INSERT INTO employee_info (id,name_first,name_mid,name_last,address,email,city,zip,designation,gender,entry_epoch) VALUE
 (:id,:first,:mid,:last,:addr,:email,:city,:zip,:des,:sex,now())";
        $sql_pass_usr = "INSERT INTO login_info (user_name,user_password,user_id) 
VALUE(:user_name,:user_password,:user_id)";
//        Access the PDO and prepare the statement
        try {
            $prep_state1 = $this->db->prepare($sql_info);
            $prep_state2 = $this->db->prepare($sql_pass_usr);
            $prep_state1->execute([
                ':id' => $this->emp['id'],
                ':first' => $this->emp['firstname'],
                ':mid' => $this->emp['middlename'],
                ':last' => $this->emp['lastname'],
                ':addr' => $this->emp['address'],
                ':email' => $this->emp['email'],
                ':city' => $this->emp['city'],
                ':zip' => $this->emp['zip'],
                ':des' => $this->emp['designation'],
                ':sex' => $this->emp['gender']
            ]);
            $prep_state2->execute([
                ':user_name' => $this->emp['emp_username'],
                ':user_password' => $this->emp['emp_password'],
                ':user_id' => $this->emp['id']
            ]);
        } catch (\PDOException $PDOException) {
            $return_value = FALSE;
        }
        return $return_value;
    }
}