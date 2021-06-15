<?php

namespace app\models\examples;



class ProductPhisic extends Product{
    
    
    public function __construct ($name = '', $price = 100){
        parent::__construct($name, $price);
        $this->name .= 'Phis';
        
    }
    

    
    protected function isCountRight($count):bool{
        return is_int($count);
    }
    
    
}