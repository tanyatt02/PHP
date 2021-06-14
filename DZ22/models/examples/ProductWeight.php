<?php

namespace app\models\examples;



class ProductWeight extends Product{
    
    
    public function __construct ($name = '', $price = 100){
        parent::__construct($name, $price);
        
        $this->name .= 'Weight';
        
    }
    
    protected function isCountRight($count):bool{
        return is_float($count) || is_int($count);
    }
    
    
}