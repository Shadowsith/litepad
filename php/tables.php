<?php 
namespace Lpad {
    class Table {
        static const USERS = 'lpad_users';
        static public $notes = 'lpad_notes';
        static public $pdf_fonts = 'lpad_pdffonts';
        static public $editors = 'lpad_editors';
        static public $lang = 'lpad_languages';
        static public $global_settings = 'lpad_global_settings';
        static public $user_settings = 'lpad_user_settings';

        public static function getUsers() {
            return self::USERS;
        }
    }
}
?>
