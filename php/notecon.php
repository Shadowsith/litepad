<?php namespace Lpad;
require_once(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/mysqlcon.php');
require_once(dirname(__FILE__).'/table.php');

class NoteCon extends MySqlCon {

    //public function __construct($server, $user, $pw, $schema, $max_user) {
    public function __construct($data) {
        parent::__construct($data);
    }

    public function addNote($name, $text, $user_id) {
        $sql = sprintf("INSERT INTO %s (name, text, user_id)" .
            "VALUES('%s', '%s', %d)", 
            Table::NOTES, $name, $text, $user_id);

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
        $sql = sprintf("SELECT name FROM %s WHERE user_id = %d",
            Table::NOTES, $user_id);

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

    public function updateNote($text, $name, $user_id) {
        $sql = sprintf("UPDATE %s SET text = '%s' WHERE name = '%s' ".
            "AND user_id = %d", Table::NOTES, $text, 
            $name, $user_id);
    }

    public function deleteNote($name, $user_id) {
        $sql = sprintf("DELETE FROM %s WHERE name = '%s' AND user_id = %d",
            Table::NOTES, $name, $user_id);
        $result = $this->getConn()->query($sql);
        if($result->num_rows > 0) {
            
        }
    }

    public function moveNote($name, $user_id) {
        $sql = sprintf("UPDATE %s SET name = '%s' WHERE name = '%s' ".
            "AND user_id = %d", Table::NOTES, $name, $user_id);
    }
}
?>
