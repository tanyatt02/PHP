<?php


use app\models\{Product, User};
use app\engine\{Autoload, Render, TwigRender};


include "../config/config.php";
include "../engine/Autoload.php";
include "../vendor/autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

/** @var Product $product */
/** @var User $user */


//index.php
//index.php?c=controller&a=action
//index.php?c=catalog&a=cart&id=5
//index.php?c=catalog
//index.php?c=basket&a=index
//index.php?c=basket&a=add&id=3

//$product = Product::getOne(1);
//$product->price = 150;
//$product->save();

//$user = new User('ttt','555');
//$user->insert();



$controllerName = $_GET['c'] ?? 'product';
$actionName = $_GET['a'] ?? null;

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName);
} else {
    echo "404 202";
}















die();




















