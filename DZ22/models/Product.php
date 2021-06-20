<?php

namespace app\models;


class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $catalog_id;
    
    public function __construct($name = '', $description = '', $price = '', $catalog_id = NULL)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->catalog_id = $catalog_id;
    }

    protected function getTableName()
    {
        return 'products';
    }


}

