<?php namespace Lpad;
// max value of notes in ./notes Folder 
$configNoteValue = 200; 

# db connection settings
# change to your database settings
$db_server = "localhost";
$db_user = "lpad_user";
$db_max_user = 20;
$db_pw = "lpad";
$db_schema = "lpad";

# do not edit blow
$db_data = new Config($db_server, $db_user, $db_max_user, 
                          $db_pw, $db_schema);

class Config {
    public $server;
    public $user;
    public $max_user;
    public $pw;
    public $schema;

    public function __construct($server, $user, $max_user, $pw, $schema) {
        $this->server = $server;
        $this->user = $user;
        $this->max_user = $max_user;
        $this->pw = $pw;
        $this->schema = $schema;
    }
}
?>

