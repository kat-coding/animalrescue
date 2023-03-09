<?php

class Validate
{
    static function validName($name)
    {
        return strlen($name) > 1 && ctype_alpha($name);
    }

    static function validPhone($phone)
    {
        $pattern = "^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$^";
        return preg_match($pattern, $phone);
    }

    static function validState($state)
    {
        return array_key_exists($state, DataLayer::getState());
    }

    static function validEmail($email)
    {
        $pattern = "^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$^";
        return preg_match($pattern, $email);
    }

    static function checkLogin($username, $password)
    {
        return $username == 'syntaxians' && $password == 'catdog';
    }

//    static function validPassword($password)
//    {
//        return $password == 'catdog';
//    }

    static function validIMGURL($imgURL)
    {
        $folder = substr($imgURL, 0, 11);
        $string = 'upload-img/';
        if($folder != $string){
            return false;
        }
        if($imgURL == 'none'){
            return false;
        }
        return true;
    }
    static function validSpecies($species){
        //TODO add validation logic
        return true;
    }
    static function validAge($age){
        return (is_numeric($age) & $age <= 99);
    }
    static function validSex($sex){
        //TODO add validation logic
        return true;
    }
    static function validMissingDate($missingdate){
        //TODO add date validation
        return true;
    }
    static function validCity($city){
        //TODO add city validation
        return true;
    }
}