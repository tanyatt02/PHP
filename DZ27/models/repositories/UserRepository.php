<?php

namespace app\models\repositories;

use app\engine\Session;
use app\models\Repository;
use app\models\entities\User;


class UserRepository extends Repository
    
{


    public  function auth($name, $pass) {

        $user = $this->getOneWhere('name', $name);
        if ($user ?? null){
            if (password_verify( $pass, $user->pass)) {
                (new Session)->set('name', $user->name);
            }
                return true;
        }
            return false;
    }
       

    public  function isAuth() {
        if (! null == (new Session)->get('name')){
            if (null == (new Session)->get('hash')){
                $hash = $_COOKIE['hash'] ?? null;
                if(isset($hash)){
                    $user = $this->getOneWhere('hash', $hash);
                    if ($user) {
                        (new Session)->set('name', $user->name);
                    }
                }
            }
        };
        return null !== (new Session)->get('name');
    }
    
    

    public static function isAdmin() { 
        return (new Session)->get('name') == 'admin';
    }

    public static function checkData($name, $pass, $pass_repeat) { 
        return ($name !== '' & stripos($name, 'guest') !== 0 & $pass == $pass_repeat);
        //return true;
    }
    
    public static function getName() {
        return (new Session)->get('name') ?? '';
    }
    //может, проще ID в SESSION записывать?
    public  function getId() {
        $name = (new Session)->get('name') ?? null;
        if ($name !== null){
            $user = $this->getOneWhere('name', $name);// ?? '';
        };
        return $user->id ?? '';
    }

    
    protected function getEntityClass() {
        return User::class;
    }
    
    public  function getTableName() {
        return 'users';
    }


}