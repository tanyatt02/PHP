<?php


namespace app\models\entities;

use app\models\Model;

class Order extends Model
{
    protected $id;
    protected $user_id;
    protected $tel;
    protected $sum;
    protected $currentBasket;
    protected $statusOrder;
    
//    id SERIAL PRIMARY KEY,
//    user_id BIGINT UNSIGNED,
//    tel VARCHAR(10),
//    sum BIGINT UNSIGNED,
//     currentBasket VARCHAR(100),
//     statusOrder ENUM('new', 'paid', 'close'),
    
    protected $props = [
        'user_id' => [
            'isUpdate' => false,
            'mbNull' => true
        ],
        'tel' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'sum' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'currentBasket' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
        'statusOrder' => [
            'isUpdate' => false,
            'mbNull' => false
        ],
    ];
    
    
    public function __construct($user_id = null, $tel = null, $sum = null, $currentBasket = null, $statusOrder = null)
    {
        $this->user_id = $user_id;
        $this->tel = $tel;
        $this->sum = $sum;
        $this->currentBasket = $currentBasket;
        $this->statusOrder = $statusOrder;
    }
    

}