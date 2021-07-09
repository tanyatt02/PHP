<?php


namespace app\models\repositories;


use app\engine\Db;
use app\models\entities\{Basket, Product};
use app\models\Repository;

class BasketRepository extends Repository
    
{

    
    public function getBasket($user_id) {
        $sql = "SELECT * FROM basket WHERE user_id = :user_id";
        $params ['user_id'] = $user_id;
        
        
        $basket = Db::getInstance()->queryAll($sql, $params);
        $list = [];
        foreach ($basket as  $row) {
           
                $product = (new ProductRepository)->getOne($row['product_id']);
                $id = $row ['id'];
                $name = $product->name;
                $price = $product->price;
            
                $list[$id]= "{$name} <span><i> цена = </i><span> {$price}";
                
        };
        return $list;
    }

    protected function getEntityClass() {
        return Basket::class;
    }
    
    protected function getTableName()
    {
        return 'basket';
    }
}