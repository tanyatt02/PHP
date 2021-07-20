<?php


namespace app\controllers;


use app\models\entities\Basket;
use app\engine\App;

class BasketController extends Controller
{


    public function actionIndex() {
        $user_id = App::call()->userRepository->getId();
        $basket = App::call()->basketRepository->getBasket($user_id);
        App::call()->session->set('mode','user');
        
        echo $this->render('basket', [
            'basket' => $basket
        ]);
    }
    
    public function actionCurrent() {
        $currentBasket = App::call()->request->getParams()['currentBasket'];
        $basket = App::call()->basketRepository->getBasketCurrent($currentBasket);
        
        echo $this->render('basket', [
            'basket' => $basket
        ]);
        
        
    }

    public function actionAdd() {

        
        $id = App::call()->request->getParams()['id'];
        
        $user_id = App::call()->userRepository->getId();
        $basket = new Basket($user_id, $id,  App::call()->userRepository->getOne($user_id)->currentBasket);
        App::call()->basketRepository->save($basket);
        $count = App::call()->basketRepository->getCountWhereBasket($user_id);
        $response = [            
            'success' => 'ok',
            'count' => $count,
            'sum' => App::call()->basketRepository->getSumWhereBasket($user_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
        
    }
    
    public function actionDelete() {

//         $data = json_decode(file_get_contents('php://input'));
        $error = 'ok';
        $id = App::call()->request->getParams()['id'];
        
        $basket = new Basket;
        
        $basket = App::call()->basketRepository->getOne($id);
        $user_id =App::call()->userRepository->getId();
        if ($user_id == $basket->user_id){
            App::call()->basketRepository->delete($basket);
        }else{
            $error = 'error';
        };
        
        $response = [            
            'success' => $error,
            'count' => App::call()->basketRepository->getCountWhereBasket($user_id),
            'sum' => App::call()->basketRepository->getSumWhereBasket($user_id)
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
        
      
        
    }

}