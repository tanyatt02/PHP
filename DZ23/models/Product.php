<?php

namespace app\models;


class Product extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $catalog_id;//оставила значения отдельно от props, чтобы работало getOne (FETCH_CLASS) и не надо было вручную их раскидывать
    
    protected $props = [
        'id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
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
        ],
    ];
    
    public function __construct($name = NULL, $description = NULL, $price = NULL , $catalog_id = NULL)
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

