<?php
namespace app\engine;

class Autoload
{

    
//1. Переписать автозагрузчик. Добавить пространство имен всем классам.
    
    function loadClass($className) {
        $className = ' '.$className;
        $className = str_replace([' app\\', '\\'], ['../', '/'], $className);
        echo "___ загружаем  {$className} <br>";
            $fileName = "{$className}.php";
            if (file_exists($fileName)) {
                include $fileName;
            
            }

        

    }
}

