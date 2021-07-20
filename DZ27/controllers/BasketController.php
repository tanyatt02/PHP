<?php


namespace app\controllers;


use app\engine\Request;
use app\engine\Session;
use app\models\entities\Basket;
use app\models\repositories\{BasketRepository, UserRepository};

class BasketController extends Controller
{


    public function actionIndex() {
        $user_id = (new UserRepository)->getId();
        $basket = (new BasketRepository)->getBasket($user_id);
        
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }

    public function actionAdd() {

        //$data = json_decode(file_get_contents('php://input'));
       
        
        //$data = (new Request)->getData();
        
        $id = (new Request)->getParams()['id'];//$data->id;
        
         $user_id = (new UserRepository)->getId();
        $basket = new Basket($user_id, $id);
        (new BasketRepository)->save($basket);
        $count = (new BasketRepository)->getCountWhere('user_id', $user_id);
        $response = [            
            'success' => 'ok',
            'count' => $count,
            'sum' => (new BasketRepository)->getSumWhere($user_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
        
    }
    
    public function actionDelete() {

//         $data = json_decode(file_get_contents('php://input'));
        $error = 'ok';
        $id = (new Request)->getParams()['id'];
        
        $basket = new Basket;
        
        $basket = (new BasketRepository)->getOne($id);
        $user_id =(new UserRepository)->getId();
        if ($user_id == $basket->user_id){
            (new BasketRepository)->delete($basket);
        }else{
            $error = 'error';
        };
        
        $response = [            
            'success' => $error,
            'count' => (new BasketRepository)->getCountWhere('user_id', $user_id),
            'sum' => (new BasketRepository)->getSumWhere($user_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
        
      
        
    }

}