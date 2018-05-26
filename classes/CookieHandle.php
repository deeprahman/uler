<?php
declare(strict_types=1);

namespace classes;
/**
 * Class CookieHandle
 * @package classes
 * Attributes:
 * $db:PDO data object
 * Properties:
 * setCookie(): Sets an encrypted cookie in the browser.
 * checkCookie():Checks the validity of a retrieved cookie.
 * signOut(): unset the cookie.
 */
class CookieHandle
{
    /**
     * @param string $name
     * @param string $value
     * @param int $expire
     * @return bool
     */
    public function setCookie(string $name, string $value, int $expire): bool
    {
        //8 characters random string.
        try{
            $random_str1 = random_bytes(8);
            $random_str2 = random_bytes(8);
        }catch (\Exception $exception){
            exit($exception->getMessage());
        }


        //concatenate the user id and random string
        $value = $random_str1 . $value . $random_str2;
        //encrypt the value
        $value = base64_encode($value);
        //set the cookie
        return setcookie($name, $value, $expire);
    }

    /**
     * @param object $db
     * @param string $cookie
     * @param string $table
     * @param array $fields
     * @return bool
     */
    public function checkCookie(object &$db, string &$cookie, string &$table, array &$fields): bool
    {
        //decode the retrieved cookie.
        $value = base64_decode($cookie);
        $value = substr($value, 8);
        $split = substr($value, -8);
        $value = explode($split, $value);
        $value = explode(',', $value[0]);
        $id = $value[0];
        $is_admin = $value[1];
        //Search the database for extracted cookie value
        $fields = implode(",", $fields);
        //The SQL query
        $sql_query = "SELECT $fields FROM $table WHERE id = :id";
        try {
            $prepare = $db->prepare($sql_query);
            $prepare->execute([':id' => $id]);
        } catch (\PDOException $exception) {
            $message = $exception->getMessage();
        }
        $results = $prepare->fetch();
        if ($results) { //the cookie  valid block
            $_SESSION['id'] = (int)$results['id'];
            $_SESSION['is_admin'] = (int)$is_admin;
            if ($_SESSION['is_admin'] === 0) {
                $_SESSION['msg'] = "Employee Logged in!";
            } else {
                $_SESSION['msg'] = "Admin Logged in!";
            }
            return TRUE;
        } else { //The cookie invalid block
            return FALSE;
        }
    }

    /**
     * @param string $name
     */
    public function signOut(string $name)
    {
        unset($_SESSION['id']);
        unset($_SESSION['is_admin']);
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]);
            setcookie($name, "", time() - 1111);
        }
        session_destroy();
    }
}