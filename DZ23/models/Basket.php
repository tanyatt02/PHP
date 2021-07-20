<?php

namespace app\models;


class Basket extends Model
{
    protected $id;
    protected $user_id;
    protected $product_id;
    protected $props = [
        'id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'user_id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'product_id' => [
            'isUpdate' => false,
            'mbNull' => false
        ]
    ];
    
    
    public function __construct($user_id = NULL, $product_id = NULL)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
    }
    


    protected function getTableName()
    {
        return 'basket';
    }


}

