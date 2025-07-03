<?php

Class User {
    
    public static function register($name, $email, $password) {
       
        return true;
    }

    public static function isEmailValid($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isPasswordStrong($password) {
        return strlen($password) >= 6; 
    }
}