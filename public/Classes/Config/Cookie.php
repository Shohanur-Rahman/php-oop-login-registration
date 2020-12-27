<?php

namespace App\Classes\Config;

class Cookie
{
    public static function exists($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    public static function put($name, $value, $expiry)
    {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }

    public static function delete($name)
    {
        //Delete my cookies here
        self::put($name, '', time() - 1);
    }
}

