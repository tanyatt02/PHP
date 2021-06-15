<?php

namespace app\models\examples;



class ProductDigit extends Product{
    
    
    public function __construct ($name = '', $price = 100){
        parent::__construct($name, $price);
        $this->price *=0.5;
        $this->name .= 'Digit';
        
    }
    
    protected function isCountRight($count):bool{
        return is_int($count);
    }
    
    
}