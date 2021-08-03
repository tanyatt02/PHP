<?php


namespace app\controllers;


use app\models\entities\Order;
use app\models\repositories\UserRepository;
use app\engine\App;

class OrderController extends Controller
{


    public function actionIndex() {
        if(App::call()->userRepository->isAdmin()){
            
            $orders = App::call()->orderRepository->getOrders();
            App::call()->session->set('mode', 'order');
            echo $this->render('orders', [
                'orders' => $orders
            ]);
        }else{
           header('Location: /'); 
        }
    }

    public function actionOrderform() {

         echo $this->render('order');
        

        
    }
    
    public function actionMade() {
        $tel = App::call()->request->getParams()['tel'];
        $currentBasket = App::call()->session->get('currentBasket');
        $user_id = App::call()->userRepository->getId();
        $user = App::call()->userRepository->getOne($user_id);
        if (App::call()->orderRepository->checkTel($tel)
            & $currentBasket == $user->currentBasket){//проверяем, что корзина пользователя
            
            $sum = App::call()->basketRepository->getSumWhereBasket($user_id);
            
            $statusOrder = 'new';
            $order = new Order($user_id, $tel, $sum, $currentBasket, $statusOrder);
            App::call()->orderRepository->save($order);
            
            $currentBasket = uniqid(rand(), true);
            $user->currentBasket = $currentBasket;
            App::call()->userRepository->save($user);
            App::call()->session->set('currentBasket', $currentBasket);
            echo "currentBasket = {$currentBasket}";
            header('Location: /');
        }else{
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }
      
        
    }
    
    public function actionSetStatus() {

       
        $currentBasket = App::call()->request->getParams()['currentBasket'];
        $value = App::call()->request->getParams()['status'];
        
        $user_id = App::call()->userRepository->getId();
        $order =  App::call()->orderRepository->getOneWhere('currentBasket', $currentBasket);
        $order->statusOrder = $value;
        App::call()->orderRepository->save($order);

        $response = [            
            'success' => 'ok'
        ];

        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
        
    }

}