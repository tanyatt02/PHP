<?php
session_start();

use app\models\{Product, User, Basket};
use app\engine\{Autoload, Render, TwigRender};


include "../config/config.php";
include "../engine/Autoload.php";
include "../vendor/autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']);

/** @var Product $product */
/** @var User $user */



$controllerName = $_GET['c'] ?? 'product';
$actionName = $_GET['a'] ?? null;

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    //$controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName);
} else {
    echo "404";
}



die();




















