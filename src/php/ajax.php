<?php
require("./litepad.php");

$noteName = $_POST['noteName']; 
$noteText = $_POST['noteText'];
$noteSave = $_POST['noteSave'];
$noteOpen = $_POST['noteOpen'];
$noteTest = $_GET['noteTest'];

if (isset($noteSave) && isset($noteText)) {
    litePadWriteNote($noteName, $noteText); 
}

if(isset($noteTest)) {
    print "works";  
}

?>
