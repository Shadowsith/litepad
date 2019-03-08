<?php namespace Lpad;
require_once(dirname(__FILE__).'/mysqlcon.php');
require_once(dirname(__FILE__).'/table.php');

class UserCon extends MySqlCon {
    private $algo = "sha512";
    private $max_user = 0;

    //public function __construct($server, $user, $pw, $schema, $max_user) {
    public function __construct($data) {
        parent::__construct($data);
        $this->max_user = $data->{'max_user'};
    }

    public function hasUserName($user) {
        $sql = sprintf("SELECT name FROM %s WHERE name = '%s'", 
            Table::USERS, $user);
        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function getUserId($user) {
        $sql = sprintf("SELECT user_id FROM %s WHERE name = '%s'", 
            Table::USERS, $user);

        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row['user_id'];
            }
        }
    }

    public function addNewUser($user, $email, $pw) {
        $decrypt_pw = hash($this->algo, $pw);
        $sql = sprintf("SELECT user_id FROM %s WHERE name = '%s'", 
            Table::USERS, $user); 

        $insert = sprintf("INSERT INTO lpad %s (name, email, password) ".
            "VALUES ('%s', '%s', '%s')", 
                           Table::USERS, $user, $email, $decrypt_pw);

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
        $sql = sprintf("SELECT user_id, password FROM %s ".
            "WHERE name = '%s' AND password = '%s'", 
            Table::USERS, $user, $decrypt_pw); 
        
        $result = $this->getConn()->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>
