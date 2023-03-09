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

    static function validUser($username)
    {
        return $username == 'syntaxians';
    }

    static function validPassword($password)
    {
        return $password == 'catdog';
    }

    static function validIMGURL($imgURL)
    {
        $folder = substr($imgURL, 0, 10);
        $regex = '/^upload-img/$/i';
        if(!preg_match($regex, $folder)){
            return false;
        }
        if($imgURL == 'none'){
            return false;
        }
        return true;
    }
}