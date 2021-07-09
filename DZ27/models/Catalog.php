<?php

namespace app\models;


class Catalog extends DBModel
{
    protected $id;
    protected $name;
    
    protected $props = [
        'id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'name' => [
            'isUpdate' => false,
            'mbNull' => false
        ]
    ];
    
    public function __construct($name = NULL)
    {
        $this->name = $name;
        
    }

    protected function getTableName()
    {
        return 'catalogs';
    }


}

