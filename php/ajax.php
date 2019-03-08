<?php namespace Lpad;
require_once(dirname(__FILE__).'/config.php');
// require_once(dirname(__FILE__).'/lpad.php');
// require_once(dirname(__FILE__).'/settingloader.php');
require_once(dirname(__FILE__).'/AjaxHandler.php');

$ajax = new AjaxHandler($_POST, $db_data);
$ajax->executeEvent();


/* $noteName = ""; */
/* if(isset($_POST['noteName'])) { */
/*     $noteName =  $_POST['noteName']; */
/* } else if (isset($_GET['noteName'])) { */
/*     $noteName = $_GET['noteName']; */
/* } */

/* $noteText =     $_POST['noteText']; */
/* $noteSave =     $_POST['noteSave']; */
/* $noteDelete =   $_POST['noteDelete']; */ 
/* $noteAdd =      $_POST['noteAdd']; */
/* $noteMove =     $_POST['noteMove']; */
/* $notePrint =    $_POST['notePrint']; */

/* $noteOpen =     $_GET['noteOpen']; */
/* $noteLoad =     $_GET['noteLoad']; */ 

/* $getSettings = $_GET['settings']; */
/* $setSettings = $_POST['settings']; */

/* $note; */

/* if(isset($noteName)) { */
/*     $note = new NoteIO($noteName); */ 
/* } */

/* if(isset($note) && isset($noteSave) && isset($noteText)) { */
/*     $note->writeNote($noteText); */ 
/* } */

/* if(isset($note) && isset($noteAdd)) { */
/*     $note->createNote(); */ 
/* } */

/* if(isset($note) && isset($noteMove)) { */
/*     $note->moveNote($noteMove); */
/* } */

/* if(isset($note) && isset($noteOpen)) { */
/*     $note->listNotes(); */ 
/*     #print($note->readNote()); */ 
/* } */

/* if(isset($note) && isset($noteLoad)) { */
/*    $note->readNote(); */  
/* } */

/* if(isset($note) && isset($noteDelete)) { */
/*     $note->deleteNote(); */ 
/* } */

/* if(isset($note) && isset($notePrint) && isset($noteText)) { */
/*     $note->printNote($noteText); */
/* } */

/* if(isset($getSettings)) { */
/*     $obj = new SettingLoader(); */
/*     print($obj->getSettings()); */
/* } */

/* if(isset($setSettings)) { */
/*     $obj = new SettingLoader(); */
/*     $obj->setSettings($setSettings); */
// }

?>
