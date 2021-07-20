<?php

namespace app\models;

//use app\interfaces\IModel;


abstract class Model
{   
    protected $props = [];
    
    public function __set($name, $value)
    {
        
        if(isset($this->props[$name])){
            $this->$name = $value;
            $this->props[$name]['isUpdate'] = true;
        };
        return $this;
        
    }

    public function __get($name)
    {
//        $value = '';
//        if(isset($this->props[$name])){
            $value =$this->$name;
//        };
        return $value;
    }
    
    public function __isset($name){
        return true;
    }


}