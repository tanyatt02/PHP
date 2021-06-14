<?php

namespace app\models;

//use app\interfaces\IModel;

class Basket extends Model
{
    public $id;
    public $goods_id;
    public $session_id;
    
    


    protected function getTableName()
    {
        return 'basket';
    }


}

