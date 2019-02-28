<?php
require_once(dirname(__FILE__).'/mysqlcon.php');

class NoteCon extends MySqlCon
{

    //public function __construct($server, $user, $pw, $schema, $max_user) {
    public function __construct($data) {
        parent::__construct($data);
    }
}

?>
