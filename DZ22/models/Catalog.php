<?php

namespace app\models;


class Catalog extends Model
{
    public $id;
    public $name;
    
    
    public function __construct($name = '')
    {
        $this->name = $name;
        
    }

    protected function getTableName()
    {
        return 'catalogs';
    }


}

