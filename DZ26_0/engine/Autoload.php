<?php

namespace app\engine;

class Autoload
{


    function loadClass($className)
    {

        $fileName = str_replace(['app\\', '\\'], [ROOT . DS, DS], $className) . ".php";

        if (file_exists($fileName)) {
            include $fileName;

        }

    }
}

