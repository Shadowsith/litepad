<?php
require_once dirname(__FILE__).'/usercon.php';

class AjaxHandler {
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

    private $open;
    private $load;

    // ajax data
    private $post_values;

    public function __construct($POST) {
        $this->addPostFields();
        $this->setGivenValues($POST);
    }

    private function addPostFields() {
        $this->post_values = [];
        array_push($this->post_values, 'user', 'email', 'pw', 'pwVerify');
        array_push($this->post_values, 'text', 'save', 'delete', 'add', 'move');
        array_push($this->post_values, 'print', 'open', 'load', 'event');
    }

    private function setGivenValues($POST) {
        foreach($this->post_values as $val) { 
            if(isset($POST[$val])) {
                $this->{$val} = $POST[$val]; 
            }
        }
    }

    public function executeEvent($db_data) {
        switch($this->event) {
            case 'login': 
                $this->login($db_data);
                break;
            case 'register': 
                $this->register($db_data);
                break;

            default: break;
        } 
    }

    private function login($db_data) {
        if(isset($this->user) && isset($this->pw)) {
            $db = new UserCon($db_data);
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

    private function register($db_data) {
        if(isset($this->user) && isset($this->email) && isset($this->pw)) {
            $db = new UserCon($db_data);
            if($db->hasConn()) {
                if(!$db->hasUserName($this->user)) {
                    if($db->addNewUser($this->user, $this->email, $this->pw)) {
                        print 'true';
                    }
                }
            }
        }
    }
}
?>
