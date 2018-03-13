<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class My_PHPMailer {
        public function My_PHPMailer() {
            require_once(__DIR__.'/PHPMailer_latest/src/Exception.php');
            require_once(__DIR__.'/PHPMailer_latest/src/OAuth.php');
            require_once(__DIR__.'/PHPMailer_latest/src/PHPMailer.php');
            require_once(__DIR__.'/PHPMailer_latest/src/POP3.php');
            require_once(__DIR__.'/PHPMailer_latest/src/SMTP.php');
        }
    }

?>