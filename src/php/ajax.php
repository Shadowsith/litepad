<?php
require("./litepad.php");

$notePostName = $_POST['notePostName']; 
$noteText =     $_POST['noteText'];
$noteSave =     $_POST['noteSave'];
$noteDelete =   $_POST['noteDelete']; 

$noteGetName =  $_GET['noteGetName']; 
$noteOpen =     $_GET['noteOpen'];
$notePrint =    $_GET['notePrint'];


if (isset($notePostName) && isset($noteSave) && isset($noteText)) {
    litePadWriteNote($notePostName, $noteText); 
}

if(isset($noteGetName) && isset($noteOpen)) {
    print(litePadReadNote($noteGetName)); 
}

if(isset($notePostName) && isset($noteDelete)) {
    litePadDeleteNote($noteName); 
}

if(isset($notePrint)) {
    print("Test"); 
}

?>
