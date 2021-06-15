<?php

namespace app\models\examples;

abstract class Product
{
    
    protected $name;
    protected $price;
    
    public function __construct ($name = '', $price = 100){
        $this->name = $name;
        $this->price = $price;
    }
    
    protected static $sum = 0;
    
    protected function isCountRight($count){
        return true;}
    
    public  function buy($count){
        
        if ($this->isCountRight($count)){
            if (get_called_class() == 'app\models\examples\ProductWeight' & $count >=100){
                static::$sum = static::$sum + $count * $this->price*0.9;
            }else{
                static::$sum = static::$sum + $count * $this->price;
            }
            return Product::$sum;
        }else{
            echo 'Некорректное кол-во товара ';
            
        }
    }
    
}

