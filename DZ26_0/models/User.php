<?php

namespace app\models;


class User extends DBModel
{
    protected $id;
    protected $name;
    protected $pass;
    
    protected $props = [
        
        'name' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'pass' => [
            'isUpdate' => false,
            'mbNull' => true
        ]
    ];
    
     public function __construct($name = null, $pass = null)
    {
        $this->name = $name;
        $this->pass = $pass;
    }

    public static function auth($name, $pass) {
        $user = User::getOneWhere('name', $name);
        if ($pass == $user->pass) {
            $_SESSION['name'] = $name;
            
            return true;
        }
        return false;
    }

    public static function isAuth() {
        return isset($_SESSION['name']);
    }

    public static function isAdmin() { 
        return $_SESSION['name'] == 'admin';
    }


    public static function getName() {
        return $_SESSION['name'] ?? '';
    }
    
    public static function getId() {
        $name = $_SESSION['name'] ?? '';
        $user = User::getOneWhere('name', $name);// ?? '';

        return $user->id ?? '';
    }

    
    public static function getTableName() {
        return 'users';
    }


}