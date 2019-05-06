<?php
    class Validator{
        static function length($value){
            if(strlen($value) == 0){
                return false;
            }
            return true;
        }
        static function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }