<?php
require_once(dirname(__FILE__).'/lpadconfig.php');

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
$db_data = new LpadConfig($db_server, $db_user, $db_max_user, 
                          $db_pw, $db_schema);
?>
