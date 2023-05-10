<?php

namespace App\classes;

class session
{


public static function start()
    {
        session_start();
    }


    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    public static function get($key)
    {
        return $_SESSION[$key];
    }


    public static function destroy()
    {
        session_destroy();
    }

    //Check over db
    public static function check()
    {
        if (isset($_SESSION["user"])) {
            return true;
        } else {
            return false;
        }
    }

}