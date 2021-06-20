<?php

use app\models\{Product, User, Basket, Order, Catalog};
use app\interfaces\IModel;
use app\engine\{Db, Autoload};
use app\models\examples\{ProductPhisic, ProductDigit, ProductWeight};


include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);



$product = new Product();
$product->display();
    
$product = $product->getOne(2);

$product = $product->getOne(3);

$product2 = new Product ('Платье', 'летнее', 555, 3);
$product2->insert();
echo '<br>';
var_dump($product2->id);

$product->display();

$product = $product->getOne($product2->id);
echo '<br>';


$product->delete();

$product->display();

$user = new User('admin','123');
$user->insert();

$user2 = new User ('alex','qwerty');
$user2->insert();

$user->display();

$basket = new Basket(1,1);
$basket->insert();

$basket->user_id = 1;
$basket->product_id = 2;
$basket->insert();

$basket->user_id = 2;
$basket->product_id = 3;
$basket->insert();

$basket->user_id = 3;
$basket->product_id = 3;
$basket->insert();

$basket->user_id = 3;
$basket->product_id = 10;
$basket->insert();


$basket->display();





die();
/*
//CREATE
$product = new Product();
$product->name = 'Чай';
$product->price = 23;
$product->insert();

//READ
$product = new Product();
$product->getOne(5);
$product->getAll();

//UPDATE
$product = new Product();
$product->getOne(5);
$product->price = 25;
$product->update();

//DELETE
$product = new Product();
$product->getOne(5);
$product->delete();
*/