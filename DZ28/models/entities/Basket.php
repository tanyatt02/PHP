<?php


namespace app\models\entities;

use app\models\Model;

class Basket extends Model
{
    protected $id;
    protected $user_id;
    protected $product_id;
    protected $currentBasket;
    
    protected $props = [
        'user_id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'product_id' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'currentBasket' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
    ];
    
    
    public function __construct($user_id = null, $product_id = null, $currentBasket = null)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->currentBasket = $currentBasket;
    }
    

}