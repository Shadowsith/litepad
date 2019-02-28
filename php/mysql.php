<?php

class SqlCon
{
    private $conn = null;
    private $algo = "sha512";

    public function __construct($server, $user, $pw, $schema) {
        $this->conn = new mysqli($server, $user, $pw, $schema);

        if($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function hasConn() {
        if($this->conn != null) {
            return true;
        }
        else return false;
    }

    public function hasUserName($user) {
        $sql = sprintf("SELECT name FROM lpad_users WHERE name = '%s'", $user);
        $result = $this->conn->query($sql);
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

        $result = $this->conn->query($sql);
        if($result->num_rows > 0) {
            return false;
        }
        if($this->conn->query($insert) === true) {
            return true;
        }  
        return false;
    }

    public function isUserValid($user, $pw) {
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
