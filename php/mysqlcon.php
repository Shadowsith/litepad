<?php

class MySqlCon
{
    private $conn = null;

    //public function __construct($server, $user, $pw, $schema, $max_user) {
    public function __construct($data) {
        $this->setConn($data);
    }

    public function setConn($data) {
        $this->conn = new mysqli($data->{'server'}, $data->{'user'},
                                 $data->{'pw'}, $data->{'schema'});

        if($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function getConn() {
        return $this->conn;
    }

    public function hasConn() {
        if($this->conn != null) {
            return true;
        }
        else return false;
    }
}
?>
