<?php
namespace app\models;


class User extends Model
{
    public $id;
    public $name;
    public $pass;
    
     public function __construct($name = '', $pass = '')
    {
        $this->name = $name;
        $this->pass = $pass;
    }

    public function getTableName() {
        return 'users';
    }


}