<?php

namespace app\models\entities;

use app\models\Model;

class Product extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $catalog_id;

    protected $props = [
        
        'name' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'description' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'price' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'catalog_id' => [
            'isUpdate' => false,
            'mbNull' => true
        ]
    ];
    
    public function __construct($name = NULL, $description = NULL, $price = NULL , $catalog_id = NULL)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->catalog_id = $catalog_id;
    }


    

}

