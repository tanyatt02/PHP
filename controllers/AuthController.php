<?php


namespace app\controllers;

//use app\models\repositories\UserRepository;
use app\models\entities\User;
//use app\engine\{Request, Session};

use app\engine\App;

class AuthController extends Controller
{
    public function actionLogin() {
        $session = App::call()->session;
        if(! is_null($session->get('mode')) &&  $session->get('mode') == 'guest'){
            header("Location: /");// . $_SERVER['HTTP_REFERER']);
            die();
        }else{
            $name = App::call()->request->getParams()['name'];
            $pass = App::call()->request->getParams()['pass'];
            $session->set('mode', 'user');//а м.б. 'admin', напр
            $save = App::call()->request->getParams()['save']?? null; 
            if (App::call()->userRepository->auth($name, $pass)) {
                if (isset($save)) {
                    $hash = uniqid(rand(), true);
                    $id = App::call()->userRepository->getId();
                    $user = App::call()->userRepository->getOne($id);
                    $user->hash = $hash;
                    App::call()->userRepository->save($user);
                    App::call()->cookies->setcookie('hash', $hash, 3600, '/');
                    //setcookie('hash', $hash, time()+3600, '/');
                };
                $id = App::call()->userRepository->getId();
                $user = App::call()->userRepository->getOne($id);
                $currentBasket=$user->currentBasket;
                $session->set('currentBasket', $currentBasket);
                header("Location: /");// . $_SERVER['HTTP_REFERER']);
                die();
            } else {
                die("Неверный логин-пароль");
            };
        };
    }

    
     public function actionGuest() {
         $session_id = App::call()->session->getId();
         $name = 'Guest_' . session_id();
         $currentBasket = uniqid(rand(), true);
         $user = new User($name, null,$currentBasket);
         App::call()->userRepository->save($user);
         
         App::call()->session->set('name', $name);
         App::call()->session->set('mode', 'guest');
         App::call()->session->set('currentBasket', $currentBasket);
         
           
         header("Location: /");// . $_SERVER['HTTP_REFERER']);
         die();
        
    }
    
    public function actionRegistrationform() {
        App::call()->session->set('mode', 'registration');
        echo $this->render('index');
        die();
        
    }
    
    public static function isReg() {
        $session = App::call()->session;
        return ($session->get('mode') != null &&  $session->get('mode') == 'registration');
    }
    
    public function actionRegistration() {
        $name = App::call()->request->getParams()['name'];
        $pass = App::call()->request->getParams()['pass'];
        $pass_repeat = App::call()->request->getParams()['pass_repeat'];
        
        if (App::call()->userRepository->checkData($name, $pass, $pass_repeat)){
            $currentBasket = uniqid(rand(), true);
            $user = new User($name, password_hash($pass, PASSWORD_DEFAULT), $currentBasket);
            var_dump($currentBasket);
            App::call()->userRepository->save($user);
            
            App::call()->session->set('name', $name);
            App::call()->session->set('mode', 'user');
            App::call()->session->set('currentBasket', $currentBasket);
            $save = App::call()->request->getParams()['save']?? null; 
            
            if (isset($save)) {
                    $hash = uniqid(rand(), true);
                    $id = App::call()->userRepository->getId();
                    $user = App::call()->userRepository->getOne($id);
                    $user->hash = $hash;
                    App::call()->userRepository->save($user);
                    App::call()->cookies->setcookie('hash', $hash, 3600, '/');
                }
            header("Location: /");
        }else{
            App::call()->session->set('mode', 'registration');
            echo $this->render('index');
        };
        
        
        die();
        
    }
    
    public function actionCancel() {
        App::call()->session->set('mode','');
        header('Location: /');
    }
    
    public function actionLogout() {
       $str = App::call()->session->get('mode');
        
        if ((App::call()->session->get('mode')) == 'guest'){
            $id = App::call()->userRepository->getId();
            $user = App::call()->userRepository->getOne($id);

            
                
        };
        
        $user_id = App::call()->userRepository->getId();
        
        $user = App::call()->userRepository->getOne($user_id);
        $user->hash = null;
        if(get_class($user) == User){
            App::call()->userRepository->save($user);
        };
        App::call()->cookies->setcookie('hash', '', -3600, '/');
        App::call()->session->regenerate();
        App::call()->session->destroy();
        header("Location: /"); //. $_SERVER['HTTP_REFERER']);
        die();
        
    }
    
    
}