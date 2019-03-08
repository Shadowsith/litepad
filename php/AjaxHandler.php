<?php namespace Lpad;
require_once(dirname(__FILE__).'/UserCon.php');
require_once(dirname(__FILE__).'/NoteCon.php');

class AjaxHandler {
    //conncetion
    private $db_data;

    // event
    private $event;

    // lpad user 
    private $user;
    private $email;
    private $pw;
    private $pwVerify;

    // note data
    private $text;
    private $save;
    private $delete;
    private $add;
    private $move;
    private $print;

    public function __construct($POST, $db_data) {
        $this->db_data = $db_data;
        $this->setGivenValues($POST);
    }

    private function setGivenValues($POST) {
        foreach($this as $key => $val) { 
            if($key != 'db_data') {
                if(isset($POST[$key])) {
                    $this->{$key} = $POST[$key]; 
                }
            }
        }
    }

    public function executeEvent() {
        switch($this->event) {
            case 'login': 
                $this->login();
                break;
            case 'register': 
                $this->register();
                break;

            default: break;
        } 
    }

    private function login() {
        if(isset($this->user) && isset($this->pw)) {
            $db = new UserCon($this->db_data);
            if($db->hasConn()) {
                if($db->isUserValid($this->user)) {
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: index.php');
                    return;
                }
            }
            $_SESSION['valid'] = false;
        }
    }

    private function register() {
        if(isset($this->user) && isset($this->email) && isset($this->pw)) {
            $db = new UserCon($this->db_data);
            if($db->hasConn()) {
                if(!$db->hasUserName($this->user)) {
                    if($db->addNewUser($this->user, $this->email, $this->pw)) {
                        print 'true';
                    }
                }
            }
        }
    }

    private function addNote() {
        if(isset($this->text)) {
        
        }
    }

    private function updateNote() {
    
    }

    private function moveNote() {
    
    }

    private function deleteNote() {
    
    }

    private function printNote() {
    
    }
}
?>
