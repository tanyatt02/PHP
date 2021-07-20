<?php
session_start();
//$_SESSION['mode'] = '';
use app\engine\App;
use app\models\RegistrationPDOException;

$config = include "../config/config.php";
include "../vendor/autoload.php";


try {
App::call()->run($config);


}catch (RegistrationPDOException $e) {
    
            App::call()->session->set('error', $e->getMessage());
            header('Location: '. $_SERVER['HTTP_REFERER']);
        
    
}catch (\PDOException $e) {
    var_dump($e->getMessage());
    App::call()->session->destroy();
echo "<br><br><br><br> Некорректные данные для БД <br>";
    
   
}catch (\Exception $e) {
    var_dump($e->getMessage());
}



die();




















