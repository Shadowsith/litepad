<?php
require("../../config.php"); 

define("NOTEFOLDER", "../../notes/");

function litePadWriteNote($noteName, $noteText) {
    if (!empty($noteText) || !isset($noteText)) {
        $fileNums = countNotes();
        if ($fileNums < 200) {
            writeNote($noteName, $noteText);
        } else {
            $errorMessage = "The maximum value of files in notes folder is reached";
            return $errorMessage;
        }   
    }
}

function litePadReadNote($noteName) {
    $noteName = NOTEFOLDER . $noteName . ".txt"; 
    if(file_exists($noteName)) {
        $noteText = "";
        $note = fopen($noteName, "r");
        while(!feof($note)) {
            $noteText = $noteText . fgets($note);
        }
        fclose($note);  
        print($noteText); 
    } else {
        print("Please enter a valid note name"); 
    } 
}

function litePadReloadNote($noteName) {

}

function litePadRenameNote($oldNoteName, $newNoteName) {

}

function litePadDeleteNote($noteName) {
    $noteName = NOTEFOLDER . $noteName . ".txt"; 
    if(file_exists($noteName)) {
        unlink($noteName); 
        print("File has been deleted!"); 
    } else {
        print("This file does not exist!"); 
    }
}

function writeNote($noteName, $noteText) {
    $note = fopen(NOTEFOLDER . $noteName . ".txt", "w");
    if(fwrite($note, $noteText)) {
        print("File has been saved sucessfully!"); 
    } else {
        print("File could not be saved, internal server error!");
    }
    fclose($note); 
}

function countNotes() {
    $noteCount = new FilesystemIterator(NOTEFOLDER, FilesystemIterator::SKIP_DOTS);
    return iterator_count($noteCount); 
}

function loadNote() {

}

function listNotes() {

}

// testing area:
//

?>

