<?php

namespace app\models;


class Basket extends Model
{
    public $id;
    public $user_id;
    public $product_id;
    
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

