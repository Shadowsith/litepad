<?php
class LpadConfig 
{
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
