<?php
require('./config.php'); 

class NoteIO 
{
    private const NOTEFOLDER = "../notes/";  

    private $errorMsg = "The maximum value of files in notes folder is reached";
    private $fileNotReadMsg = "File could not be saved, internal server error!"; 
    private $deleteMsg = "File has been deleted!";
    private $fileNotFoundMsg = "File could not be found!"; 
    private $noteName; 
    private $path; 

    function __construct($name) {
        $this->noteName = $name; 
        $this->path = self::NOTEFOLDER . $this->noteName . ".txt"; 
    }

    private function countNotes() {
        $noteCount = new FilesystemIterator(self::NOTEFOLDER, FilesystemIterator::SKIP_DOTS);
        return iterator_count($noteCount); 
    }

    public function getNoteName() {
        return $this->noteName; 
    }

    public function setNoteName($name) {
        $this->noteName = $name; 
    }

    public function createNote() {
        $fileNums = $this->countNotes();
        if ($fileNums < 200) {
            $note = fopen($this->path, "w");
            fclose($note); 
            print("New empty file has been created");
        } else {
            print($this->errorMsg);
        }   
    }

    public function writeNote($text)
    {
        if (!empty($text) || !isset($text)) {
            $fileNums = $this->countNotes();
            if ($fileNums < 200) {
                $note = fopen($this->path, "w");
                if(!fwrite($note, $text)) {
                    print($this->fileNotReadMsg);
                }
                fclose($note); 
                print("File has been saved!");
            } else {
                print($this->errorMsg);
            }   
        }
    }

    public function readNote()
    {
        $text = "";
        if(file_exists($this->path)) {
            $note = fopen($this->path, "r");
            while(!feof($note)) {
                $text = $text . fgets($note);
            }
            fclose($note);  
            print($text); 
        } else {
            print($this->fileNotFoundMsg); 
        } 
    }

    public function moveNote($newName) 
    {
        if(file_exists($this->path)) {
            $newPath = self::NOTEFOLDER . $newName . ".txt"; 
            if(rename($this->path, $newPath)) {
                print("File " . $this->$noteName . " has been successful moved to " . $newName);
            } else {
               print("File " . $this->$noteName . " couldn't moved");
            }
        } else {
            print("File does not exit!");
        }
    }

    public function deleteNote() 
    {
        if(file_exists($this->path)) {
            unlink($this->path); 
            print($this->deleteMsg); 
        } else {
            print("This file does not exist!"); 
        }
    }

    public function listNotes() 
    {
        $notes = preg_grep('/^([^.])/', scandir(self::NOTEFOLDER)); 
        foreach($notes as &$value) {
            $value = substr($value, 0, -4); 
        } 
        $string = "";
        foreach($notes as $value) {
            $string = $string . '<li><a href="#" class="noteLoad">' . $value . '</a></li>';  
        }
        $string = substr($string, 0, strlen($string)-1);
        $rpos = strrpos($string, ";"); 
        $string = substr($string, 0, $rpos); 
        print($string); 
    }
}

// testing area:
//$n = new NoteIO("");
//$n->listNotes(); 
?>

