<?php


namespace app\models\repositories;


use app\models\entities\{Basket, Product};
use app\models\Repository;
use app\engine\App;

class BasketRepository extends Repository
    
{

    

    
    public function getBasket($user_id) {

        return $this->getJoinWhere(['basket.id basket_id',
                                         'products.id products_id',
                                         'products.name',
                                         'products.description',
                                         'products.price'],
                                        ['product_id'],
                                        ['user_id' => $user_id,
                                         'currentBasket' => 
                App::call()->userRepository->getOne($user_id)->currentBasket]);
        ;
        
    }
    
    public function getBasketCurrent($currentBasket) {
        return $this->getJoinWhere(['basket.id      basket_id',
            'products.id products_id',
            'products.name',
            'products.description',
            'products.price'],
            ['product_id'],
            [
            'currentBasket' => 
                $currentBasket]);
        ;
        
    }
    
    public function getCountWhereBasket($user_id) {
        if($user_id != ''){
            $currentBasket =  App::call()->userRepository->getOne($user_id)->currentBasket;
        
        return $this->getCountWhere(
                ['product_id'],
                ['user_id' => $user_id,
                'currentBasket' => 
                    $currentBasket]);
        ;}
        
    }
    
     public function getSumWhereBasket($user_id) {
        if($user_id != ''){
            $currentBasket =  App::call()->userRepository->getOne($user_id)->currentBasket;
        
        return $this->getSumWhere(
                ['product_id'],
                ['user_id' => $user_id,
                'currentBasket' => 
                    $currentBasket]);
        ;}
        
    }

    protected function getEntityClass() {
        return Basket::class;
    }
    
    protected function getTableName()
    {
        return 'basket';
    }
}