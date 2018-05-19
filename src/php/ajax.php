<?php
require("./litepad.php");


$notePostName = $_POST['notePostName']; 
$noteText =     $_POST['noteText'];
$noteSave =     $_POST['noteSave'];
$noteDelete =   $_POST['noteDelete']; 

$noteGetName =  $_GET['noteGetName']; 
$noteOpen =     $_GET['noteOpen'];
$notePrint =    $_GET['notePrint'];

$note;

if (isset($notePostName)) {
    $note = new NoteIO($notePostName); 
}

if (isset($noteGetName)) {
    $note = new NoteIO($noteGetName); 
}

if (isset($note) && isset($noteSave) && isset($noteText)) {
    $note->writeNote($noteText); 
}

if(isset($note) && isset($noteOpen)) {
    $note->listNotes(); 
    #print($note->readNote()); 
}

if(isset($note) && isset($noteDelete)) {
    $note->deleteNote(); 
}

if(isset($notePrint)) {
    print("Test"); 
}

?>
