<?php

namespace app\models;

use app\interfaces\IModel;


abstract class Model implements IModel
{   
    protected $props = [];
    
    public function __set($name, $value)
    {
        $this->$name = $value;
        $this->props [$name]['isUpdate'] = true;
        return $this;
    }

    public function __get($name)
    {
        return $this->$name;
    }


}