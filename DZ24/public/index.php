<?php

use app\models\{Product, User};
use app\engine\Autoload;

include "../config/config.php";
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

/** @var Product $product */
/** @var User $user */


//index.php
//index.php?c=controller&a=action
//index.php?c=catalog&a=cart&id=5
//index.php?c=catalog
//index.php?c=basket&a=index
//index.php?c=basket&a=add&id=3


$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
} else {
    echo "404";
}















die();
//INSERT
$product = new Product("Книга", "Фантастика", 23);
$product->save();



//UPDATE GET
$product = Product::getOne(1);
$product->price = 23;
$product->save();


//DELETE
$product = Product::getOne(1);
$product->delete();























