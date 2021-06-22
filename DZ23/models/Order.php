<?php

namespace app\models;


class Order extends Model
{
    protected $id;
    protected $name;
    protected $phone;
    protected $session_id;
    
    


    protected function getTableName()
    {
        return 'orders';
    }


}

