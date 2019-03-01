<?php

require_once(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/mysqlcon.php');

class NoteCon extends MySqlCon
{

    //public function __construct($server, $user, $pw, $schema, $max_user) {
    public function __construct($data) {
        parent::__construct($data);
    }

    public function addNote($name, $text, $user_id) {
        $sql = sprintf("INSERT INTO lpad_notes (name, text, user_id)" .
                       "VALUES('%s', '%s', %d)", $name, $text, $user_id);

        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            return false;
        }
        if($this->getConn()->query($insert) === true) {
            return true;
        }  
        return false;
    }

    public function getNotes($user_id) {
        $sql = sprintf("SELECT name FROM lpad_notes WHERE user_id = %d",
                        $user_id);

        $res = '';
        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $res = $res . sprintf('<li><h5><a class="noteList" href="#">'.
                                '%s</a></h5></li>', $row['name']);
            }
        }
        return $res;
    }

    public function deleteNote($name, $user_id) {
        $sql = sprintf("DELETE FROM lpad_users WHERE name = '%s', user_id = %d",
                      $name, $user_id);
        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            
        }
    }

    public function moveNote($name, $user_id) {

    }
}

/* $db = new NoteCon($db_data); */
/* $db->addNote('Bla', 'Hallo alle', 1); */
/* echo $db->getNotes(1); */

?>
