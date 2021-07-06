<?php


namespace app\models;

use app\engine\Db;

class Basket extends DBModel
{
    protected $id;
    protected $user_id;
    protected $product_id;
    
    protected $props = [
        'user_id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'product_id' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
    ];
    
    
    public function __construct($user_id = null, $product_id = null)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
    }
    
    public static function getBasket($user_id) {
        $sql = "SELECT * FROM basket WHERE user_id = :user_id";
        $params ['user_id'] = $user_id;
        
        
        $basket = Db::getInstance()->queryAll($sql, $params);
        $list = [];
        foreach ($basket as  $row) {
           
                $product = (new Product)->getOne($row['product_id']);
                $id = $row ['id'];
                $name = $product->name;
                $price = $product->price;
            
                $list[$id]= "{$name} <span><i> цена = </i><span> {$price}";
                
        };
        return $list;
    }

    protected static function getTableName()
    {
        return 'basket';
    }
}