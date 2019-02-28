<?php
require_once(dirname(__FILE__).'/mysqlcon.php');

class UserCon extends MySqlCon
{
    private $algo = "sha512";
    private $max_user = 0;

    //public function __construct($server, $user, $pw, $schema, $max_user) {
    public function __construct($data) {
        parent::__construct($data);
        $this->max_user = $data->{'max_user'};
    }

    public function hasUserName($user) {
        $sql = sprintf("SELECT name FROM lpad_users WHERE name = '%s'", $user);
        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function addNewUser($user, $email, $pw) {
        $decrypt_pw = hash($this->algo, $pw);
        $sql = sprintf("SELECT user_id FROM lpad_users WHERE name = '%s'", 
                        $user); 
        $insert = sprintf("INSERT INTO lpad_users (name, email, password) 
                           VALUES ('%s', '%s', '%s')", 
                           $user, $email, $decrypt_pw);

        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            return false;
        }
        if($this->getConn()->query($insert) === true) {
            return true;
        }  
        return false;
    }

    public function isUserValid($user, $pw) {
        $decrypt_pw = hash($this->algo, $pw);
        $sql = sprintf("SELECT user_id, password FROM lpad_users 
            WHERE name = '%s' AND password = '%s'", $user, $decrypt_pw); 
        
        $result = $this->getConn()->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
