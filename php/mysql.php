<?php
require("./config.php");

class SqlCon
{
    private $conn = null;
    private $servername = "localhost";

    function __construct($username, $password) {
        $this->conn = new mysqli($this->servername, $username, $password);

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
}

?>
