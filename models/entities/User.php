<?php

namespace app\models\entities;

use app\models\Model;

class User extends Model
    
{
    protected $id;
    protected $name;
    protected $pass;
    protected $hash;
    protected $currentBasket;
    
    
    
    protected $props = [
        
        'name' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'pass' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'hash' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'currentBasket' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
    ];
    
     public function __construct($name = null, $pass = null, $currentBasket = null)
    {
        $this->name = $name;
        $this->pass = $pass;
        $this->currentBasket = $currentBasket;
         
    }


}