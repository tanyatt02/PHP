<?php
namespace app\engine;

class Autoload
{

    

    
    function loadClass($className) {
        $className = ' '.$className;
        $className = str_replace([' app\\', '\\'], [ROOT.DS, DS], $className);
            $fileName = "{$className}.php";
            if (file_exists($fileName)) {
                include $fileName;
            
            }

        

    }
}

