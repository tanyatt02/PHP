<?php


namespace app\models;


class Basket extends DBModel
{
    protected $id;
    protected $user_id;
    protected $product_id;
    protected $props = [
        'id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'user_id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'product_id' => [
            'isUpdate' => false,
            'mbNull' => false
        ]
    ];
    
    
    public function __construct($user_id = NULL, $product_id = NULL)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
    }
    
    public function getBasket($user_id = 2) {
        $basket = Basket::getAll();
        
        $list = [];
        $sum = 0;
        foreach ($basket as  $row) {
            if ($row['user_id'] == 2) {
                //$str = '';
                $name = (new Product)->getOne($row['product_id'])->name;
                $price = (new Product)->getOne($row['product_id'])->price;
                $list[]= "{$name} <i> цена = </i> {$price}";
                $sum += $price;
                
            }
        };
        $list[] = "ИТОГО {$sum} $";
        
        return $list;
    }

    protected static function getTableName()
    {
        return 'basket';
    }
}