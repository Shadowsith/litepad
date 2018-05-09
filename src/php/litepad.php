<?php
require("../../config.php"); 

define("NOTEFOLDER", "../../notes/");

function litePadWriteNote($noteName, $noteText) {
    if (!empty($noteText) || !isset($noteText)) {
        $fileNums = countNotes();
        //print("Note Written"); 
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
        return $noteText; 
    }
}

function litePadReloadNote($noteName) {

}

function litePadRenameNote($oldNoteName, $newNoteName) {

}

function litePadDeleteNote($noteName) {
    $noteName = NOTEFOLDER . $noteName . ".txt"; 
    unlink($noteName); 
}

function writeNote($noteName, $noteText) {
    try {
        $note = fopen(NOTEFOLDER . $noteName . ".txt", "w");
        if(!fwrite($note, $noteText)) {
            print("Writing fails"); 
        }
    } catch (Exception $e) {
        print("Bla" . $e); 
    }
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

