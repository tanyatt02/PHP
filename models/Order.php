<?php

namespace app\models;


class Order extends Model
{
    public $id;
    public $name;
    public $phone;
    public $session_id;
    
    


    protected function getTableName()
    {
        return 'orders';
    }


}

