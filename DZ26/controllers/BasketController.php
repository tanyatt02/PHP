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

        $data = json_decode(file_get_contents('php://input'));
        $id = $data->id;
        
         $user_id = User::getId();
        (new Basket($user_id, $id))->save();
        $count = Basket::getCountWhere('user_id', $user_id);
        $response = [            
            'success' => 'ok',
            'count' => $count,
            'sum' => Basket::getSumWhere($user_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //die();
        
    }
    
    public function actionDelete() {

         $data = json_decode(file_get_contents('php://input'));
        $id = $data->id;
        
        (new Basket)->getOne($id)->delete();
        $user_id = User::getId();
        $response = [            
            'success' => 'ok',
            'count' => Basket::getCountWhere('user_id', $user_id),
            'sum' => Basket::getSumWhere($user_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //die();
        
      
        
    }

}