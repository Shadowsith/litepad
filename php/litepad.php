<?php
require('config.php'); 
require('vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// be careful if change enumerations
// change also lpad.js ajax message handling
abstract class MsgEnum 
{
    const Error = 0;

        const Max_files = 0;
        const File_not_found = 1;
        const File_not_saved = 2;
        const File_not_exist = 3;
        const File_not_renamed = 4;

    const Success = 1; 
        
        const File_saved = 0;
        const File_deleted = 1;
        const File_pdf = 2;
        const File_renamed = 3;
        const File_added = 4;
}

class NoteIO 
{
    private const NOTEFOLDER = "../notes/";  
    private const PDFFOLDER = "../pdf/";

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
               print("File " . $this->$noteName . " couldn't renamed");
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
        $array = scandir(self::NOTEFOLDER); 
        $notes = array_slice($array, 2);
        $res = "";
        foreach($notes as $note) {
            $note = substr($note, 0, -4); // cut off .txt
            $res = $res . '<li><h5><a class="noteList" href="#">' . $note . "</a></h5></li>";
        }
        print($res); 
    }

    public function printNote($html) 
    {
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $dompdf = new Dompdf($options);
        $dompdf->set_protocol(WWW_ROOT);
        $dompdf->set_base_path('../');

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents(self::PDFFOLDER . 'print.pdf', $output);
        print("File has saved as pdf");
    }
}

// testing area:
//$n = new NoteIO("");
//$n->listNotes(); 
?>

