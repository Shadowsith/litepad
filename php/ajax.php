<?php
require("./lpad.php");
require("./settingloader.php");

$noteName = "";
if(isset($_POST['noteName'])) {
    $noteName =  $_POST['noteName'];
} else if (isset($_GET['noteName'])) {
    $noteName = $_GET['noteName'];
}

$noteText =     $_POST['noteText'];
$noteSave =     $_POST['noteSave'];
$noteDelete =   $_POST['noteDelete']; 
$noteAdd =      $_POST['noteAdd'];
$noteMove =     $_POST['noteMove'];
$notePrint =    $_POST['notePrint'];

$noteOpen =     $_GET['noteOpen'];
$noteLoad =     $_GET['noteLoad']; 

$getSettings = $_GET['settings'];
$setSettings = $_POST['settings'];

$note;

if(isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pw'])) {
    $user = $_POST['user'];
    $mail = $_POST['email'];
    $pw = $_POST['pw'];

    $db = new SqlCon($db_server, $db_user, $db_pw, $db_schema);
    if($db->hasConn()) {
        if(!$db->hasUserName($user)) {
            if($db->addNewUser($user, $mail, $pw)) {
                print 'true';
            }
        }
    }
}

if(isset($noteName)) {
    $note = new NoteIO($noteName); 
}

if(isset($note) && isset($noteSave) && isset($noteText)) {
    $note->writeNote($noteText); 
}

if(isset($note) && isset($noteAdd)) {
    $note->createNote(); 
}

if(isset($note) && isset($noteMove)) {
    $note->moveNote($noteMove);
}

if(isset($note) && isset($noteOpen)) {
    $note->listNotes(); 
    #print($note->readNote()); 
}

if(isset($note) && isset($noteLoad)) {
   $note->readNote();  
}

if(isset($note) && isset($noteDelete)) {
    $note->deleteNote(); 
}

if(isset($note) && isset($notePrint) && isset($noteText)) {
    $note->printNote($noteText);
}

if(isset($getSettings)) {
    $obj = new SettingLoader();
    print($obj->getSettings());
}

if(isset($setSettings)) {
    $obj = new SettingLoader();
    $obj->setSettings($setSettings);
}

?>
