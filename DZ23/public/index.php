<?php

use app\models\{Product, User, Basket, Order, Catalog, Model};
use app\interfaces\IModel;
use app\engine\{Db, Autoload};
use app\models\examples\{ProductPhisic, ProductDigit, ProductWeight};


include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

Model::newBase();//создание и начальное заполнение БД

$product = new Product();

//$product->display();//выводит всю таблицу products
    
$product = $product->getOne(2);


$product = $product->getOne(3);

$product2 = new Product ('Платье', 'летнее', 555, 3);
$product2->insert();

$product2 = new Product ('Платье', 'летнее', 555, 4);
$product2->insert();//в catalogs нет строки с id=4, заменяется NULL, т.к. тут NULL допустимо


$product = $product->getOne($product2->id);



$product->delete();

//$product->display();

$product2 = new Product;
$product = $product->getOne(1);
//$product->display();


$product->price = 100;
$product->update();//сработает
$product->update();//не сработает, т.к. флаги isUpdate установлены в false
$product->display();




$user = (new User('admin','123'))->insert();//например, так можно без статики, возможно


(new User('alex','qwerty'))->insert();

$user->display();

(new Basket(1,1))->save();

(new Basket(1,2))->save();

(new Basket(2,3))->save();

(new Basket(3,3))->save();







(new Basket)->getOne(1)->__set('product_id',100)->save();


// не сработает. в products нет строки id=100, а NULL в этом поле недопустимо props[product_id][mbNull]) = false




$basket = (new Basket)->getOne(4);
//$basket = $basket->getOne(4);
$basket->product_id = 6;
$basket->user_id = 2;
$basket->save();// сработает. не NULL заказал Pen, а alex платье
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