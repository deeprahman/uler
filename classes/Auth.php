<?php


namespace classes;

/**
 * Class Auth
 * input PDO instance
 * input User name/id.
 * input password
 */
class Auth
{
    protected $user_name;
    protected $password;
    protected $db;

    public function __construct(object &$db,
                                string &$user_name,
                                string &$password)
    {
        $this->user_name =& $user_name;
        $this->password =& $password;
        $this->db =& $db;
    }

    //Check for the Eemployee
    public function checkEmployee()
    {
        $sql = "SELECT user_id,user_password FROM login_info WHERE user_name = :username";
        try {
            $prep_state = $this->db->prepare($sql);
            $prep_state->execute([":username" => $this->user_name]);
        } catch (\PDOException $PDOException) {
            echo "Query error. " . $PDOException->getMessage();
        }
        while ($row = $prep_state->fetch()) {
            $user_id = $row["user_id"];
            $user_password = $row["user_password"];
            if (password_verify($this->password,$user_password)) {
                return ['id' => $user_id];
            }
        }
        return FALSE;
    }

    //Check for the admin
    public function checkAdmin()
    {
        $sql = "SELECT id,admin_pass FROM admin WHERE admin_user = :username";
        try {
            $prep_state = $this->db->prepare($sql);
            $prep_state->execute([":username" => $this->user_name]);
        } catch (\PDOException $PDOException) {
            echo "Query error. " . $PDOException->getMessage();
        }
        while ($row = $prep_state->fetch()) {
            $user_id = $row["id"];
            $user_password = $row["admin_pass"];
            if (password_verify($this->password,$user_password)) {
                return ['id' => $user_id];
            }
        }
        return FALSE;
    }


}