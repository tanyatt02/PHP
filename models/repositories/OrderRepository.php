<?php


namespace app\models\repositories;


//use app\engine\Db;
use app\models\entities\Order;
use app\models\Repository;
use app\engine\App;

class OrderRepository extends Repository
    
{

    public  function checkTel($tel) { 
        return (preg_match('/^[0-9]{10}$/', $tel));
        
    }
    
    public function getOrders() {

        return $this->getJoin(
            ['orders.id order_id' ,
            'users.name user_name',
            'orders.currentBasket currentBasket',
            'tel',
            'sum',
            'statusOrder'],
                                         
            ['user_id'],
            );
        ;
        
    }

    
    
    
    protected function getEntityClass() {
        return Order::class;
    }
    
    protected function getTableName()
    {
        return 'orders';
    }
}