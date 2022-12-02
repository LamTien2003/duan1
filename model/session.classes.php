<?php
    class Session {
        public static $test = 'test ne';
        public static function init() {
            session_start();
            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }
        }
       
        public static function setValueSession($key,$value) {
            $_SESSION["$key"] = $value;
        }
        public static function getValueSession($key) {
            return (isset($_SESSION["$key"])) ? $_SESSION["$key"] : '';
        }
        public static function unsetSession($value) {
            unset($_SESSION["$value"]);
        }

    }
?>