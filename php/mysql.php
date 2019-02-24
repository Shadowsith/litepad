<?php

class SqlCon
{
    private $conn = null;
    private $algo = "sha512";

    function __construct($server, $user, $pw, $schema) {
        $this->conn = new mysqli($server, $user, $pw, $schema);

        if($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
            $this->conn->close();
            $this->conn = null;
        }
    }

    function hasConn() {
        if($this->conn != null) {
            return true;
        }
        else return false;
    }

    function addNewUser($user, $pw) {
        $decrypt_pw = hash($this->algo, $pw);
        $sql = sprintf("SELECT user_id FROM lpad_users WHERE name = '%s'", $user); 
        $insert = sprintf("INSERT INTO lpad_users (name, password) 
                           VALUES ('%s', '%s')", $user, $decrypt_pw);
        echo $insert;
        
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return false;
        }
        if($this->conn->query($insert) === true) {
                return true;
        }  
        return false;
    }

    function isUserValid($user, $pw) {
        $decrypt_pw = hash($this->algo, $pw);
        $sql = sprintf("SELECT user_id, password FROM lpad_users 
            WHERE name = '%s' AND password = '%s'", $user, $decrypt_pw); 
        
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}

?>
