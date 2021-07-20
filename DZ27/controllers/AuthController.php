<?php


namespace app\controllers;

use app\models\repositories\UserRepository;
use app\models\entities\User;
use app\engine\{Request, Session};

class AuthController extends Controller
{
    public function actionLogin() {
        $session = new Session;
        if($session->get('mode') != null &&  $session->get('mode') == 'guest'){
            header("Location: /");// . $_SERVER['HTTP_REFERER']);
            die();
        }else{
            $name = (new Request())->getParams()['name'];
            $pass = (new Request())->getParams()['pass'];
            $session->set('mode', 'user');//а м.б. 'admin', напр
            $save = (new Request())->getParams()['save']?? null; 
            if ((new UserRepository)->auth($name, $pass)) {
                if (isset($save)) {
                    $hash = uniqid(rand(), true);
                    $id = (new UserRepository)->getId();
                    $user = (new UserRepository)->getOne($id);
                    $user->hash = $hash;
                    (new UserRepository)->save($user);
                    setcookie('hash', $hash, time()+3600, '/');
                }
                header("Location: /");// . $_SERVER['HTTP_REFERER']);
                die();
            } else {
                die("Неверный логин-пароль");
            };
        };
    }

    
     public function actionGuest() {
         $session_id = (new Session)->getId();
         $name = 'Guest_' . session_id();
         $user = new User($name);
         (new UserRepository())->save($user);
         
         (new Session)->set('name', $name);
         (new Session)->set('mode', 'guest');
           $str = (new Session)->get('mode');
        
         header("Location: /");// . $_SERVER['HTTP_REFERER']);
         die();
        
    }
    
    public function actionRegistrationform() {
        (new Session)->set('mode', 'registration');
        echo $this->render('index');
        die();
        
    }
    
    public static function isReg() {
        $session = new Session;
        return ($session->get('mode') != null &&  $session->get('mode') == 'registration');
    }
    
    public function actionRegistration() {
        $name = (new Request)->getParams()['name'];
        $pass = (new Request)->getParams()['pass'];
        $pass_repeat = (new Request)->getParams()['pass_repeat'];
        
        if ((new UserRepository())->checkData($name, $pass, $pass_repeat)){
            $user = new User($name, password_hash($pass, PASSWORD_DEFAULT));
            (new UserRepository())->save($user);
            
            (new Session)->set('name', $name);
            (new Session)->set('mode', 'user');
            $save = (new Request())->getParams()['save']?? null; 
            
            if (isset($save)) {
                    $hash = uniqid(rand(), true);
                    $id = (new UserRepository)->getId();
                    $user = (new UserRepository)->getOne($id);
                    $user->hash = $hash;
                    (new UserRepository)->save($user);
                    setcookie('hash', $hash, time()+3600, '/');
                }
            header("Location: /");
        }else{
            (new Session)->set('mode', 'registration');
            echo $this->render('index');
        };
        
        
//        (new Session)->set('mode', 'registration');
//        echo $this->render('index');
     
            die();
        
    }
    
    
    public function actionLogout() {
       $str = (new Session)->get('mode');
        
        if (((new Session)->get('mode')) == 'guest'){
            $id = (new UserRepository())->getId();
            $user = (new UserRepository())->getOne($id);
        
            (new UserRepository())->delete($user);
            
            
                
        };
        setcookie('hash','', time()-3600, '/');
        (new Session)->regenerate();
        (new Session)->destroy();
        header("Location: /"); //. $_SERVER['HTTP_REFERER']);
        die();
        
    }
    
    
}