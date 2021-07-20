<?php

namespace app\models;


class User extends DBModel
{
    protected $id;
    protected $name;
    protected $pass;
    
    protected $props = [
        'id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'name' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'pass' => [
            'isUpdate' => false,
            'mbNull' => true
        ]
    ];
    
     public function __construct($name = '', $pass = '')
    {
        $this->name = $name;
        $this->pass = $pass;
    }

    public static function getTableName() {
        return 'users';
    }


}