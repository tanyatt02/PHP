<?php

namespace app\models\repositories;

use app\models\{Repository, RegistrationPDOException};
use app\models\entities\User;
use app\engine\App;


class UserRepository extends Repository
    
{


    public  function auth($name, $pass) {

        $user = $this->getOneWhere('name', $name);
        if ($user ?? null){
            if (password_verify( $pass, $user->pass)) {
                App::call()->session->set('name', $user->name);
            }
                return true;
        }
            return false;
    }
       

    public  function isAuth() {
        if (! is_null(App::call()->session->get('name'))){
            if (is_null(App::call()->session->get('hash'))){
                $hash = $_COOKIE['hash'] ?? null;
                if(isset($hash)){
                    $user = $this->getOneWhere('hash', $hash);
                    if ($user) {
                        App::call()->session->set('name', $user->name);
                    }
                }
            }
        };
        return !(is_null(App::call()->session->get('name')));
    }
    
    

    public  function isAdmin() { 
        
        $isAdmin = App::call()->session->get('name') == 'admin';
//        if ($isAdmin){
//             $isAdmin = App::call()->session->get('name') == 'admin';
//        }
        return $isAdmin;
    }

    public  function checkData($name, $pass, $pass_repeat) { 
        if ($name == '') {
            throw new RegistrationPDOException("Имя пользователя не должно быть пусто", 404);}
        if ( App::call()->userRepository->getOneWhere('name', $name) !== false) {
            throw new RegistrationPDOException("Выберите иное имя пользователя", 404);}
        if (strpos($name, 'Guest') === 0) {
            throw new RegistrationPDOException("Имя пользователя не должно начинаться с Guest", 404);}
        if ($pass !== $pass_repeat) {
            throw new RegistrationPDOException("Пароли должны совпадать", 404);}
        App::call()->session->set('error', '');
        return true;
        
    }
    
    public  function getName() {
        return App::call()->session->get('name') ?? '';
    }
    //может, проще ID в SESSION записывать?
    public  function getId() {
        $name = App::call()->session->get('name') ?? null;
        if (! is_null($name)){
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