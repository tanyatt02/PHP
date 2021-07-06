<?php


namespace app\controllers;


use app\models\{Basket, User};

class BasketController extends Controller
{


    public function actionIndex() {
        $user_id = User::getId();
        $basket = Basket::getBasket($user_id);
        
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }

    public function actionAdd() {
        $user_id = User::getId();
        $product_id = $_POST['id'] ;
        (new Basket($user_id,$product_id))->save();
        
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
        
    }
    
    public function actionDelete() {

        $id = $_POST['id'] ;
        
        (new Basket)->getOne($id)->delete();
        
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
        
    }

}