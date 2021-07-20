<?php


namespace app\engine;


class Cookies
{
    public function setcookie($name, $value, $time, $path)
    {
        setcookie($name, $value, time()+$time, $path);
    }

    
}