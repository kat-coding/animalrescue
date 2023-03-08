<?php

class Validate
{
    function validName($name)
    {
        return strlen($name) > 1 && ctype_alpha($name);
    }

    function validPhone($phone)
    {
        $pattern = "^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$^";
        return preg_match($pattern, $phone);
    }

    function validState($state)
    {
        return array_key_exists($state, DataLayer::getState());
    }

    function validEmail($email)
    {
        $pattern = "^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$^";
        return preg_match($pattern, $email);
    }

    function validUser($username)
    {
        return $username == 'syntaxians';
    }

    function validPassword($password)
    {
        return $password == 'catdog';
    }

    function validURL()
    {
        return true;
    }
}