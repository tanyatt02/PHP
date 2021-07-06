<?php


namespace app\controllers;

use app\models\User;

class AuthController extends Controller
{
    public function actionLogin() {
        if (User::auth($_POST['name'], $_POST['pass'])) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die("Неверный логин-пароль");
        };
    }
    
    
    public function actionLogout() {
        session_regenerate_id();
        session_destroy();
        header("Location: /"); //. $_SERVER['HTTP_REFERER']);
        die();
    }
    
    
}