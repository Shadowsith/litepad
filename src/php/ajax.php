<?php
require("./litepad.php");

$noteName = $_POST['noteName']; 
$noteText = $_POST['noteText'];
$noteSave = $_POST['noteSave'];
$noteDelete = $_POST['noteDelete']; 
$noteOpen = $_GET['noteOpen'];

if (isset($noteName) && isset($noteSave) && isset($noteText)) {
    litePadWriteNote($noteName, $noteText); 
}

if(isset($noteName) && isset($noteOpen)) {
    print(litePadReadNote($noteName)); 
}

if(isset($noteName) && isset($noteDelete)) {
    litePadDeleteNote($noteName); 
}

?>
