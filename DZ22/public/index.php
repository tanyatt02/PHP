<?php

use app\models\{Product, User, Basket, Order};
use app\interfaces\IModel;
use app\engine\{Db, Autoload};
use app\models\examples\{ProductPhisic, ProductDigit, ProductWeight};



include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);


$db = new Db();

$product = new Product($db);

$product->getOne(15);
$product->getAll();


$user = new User($db);

$user->getOne(2);
$user->getAll();

$basket = new Basket($db);

$basket->getAll();

$order = new Order($db);

$order->getOne(10);


function foo(IModel $model) {
    $model->getAll();
}

foo($product);
echo $product->insert(['pen', 'very good pen', 100, 0]) . '<br>';

$user->foo($user);


//3. 
$good = new ProductPhisic();
echo 'SUMMA = ' . $good->buy(10) . ' -  покупаем 10 единиц по 100<br>';

echo 'SUMMA = ' . $good->buy(1.9) . '<br>';

echo 'SUMMA = ' . $good->buy('mmm') . '<br>';

$good1 = new ProductDigit();
echo 'SUMMA = ' . $good1->buy(10) . ' -  покупаем 10 единиц по 100/2=50<br>';

$good2 = new ProductWeight();
echo 'SUMMA = ' . $good2->buy(0.35) . ' -  покупаем на вес 0,35кг по 100<br>';

$good2 = new ProductWeight();
echo 'SUMMA = ' . $good2->buy(100) . ' -  покупаем на вес 100кг со скидкой по 90<br>';



























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