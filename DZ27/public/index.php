<?php
session_start();
//$_SESSION['mode'] = '';

//use app\models\{Product, User, Basket};
use app\engine\{Autoload, Render, TwigRender, Request, Session};


include "../config/config.php";
//include "../engine/Autoload.php";
include "../vendor/autoload.php";


try {

//spl_autoload_register([new Autoload(), 'loadClass']);
//теперь работает vendor-автозагрузчик
/** @var Product $product */
/** @var User $user */


//(new User)->display();

$request = new Request();


$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();
    
    
//$controllerName = $_GET['c'] ?? 'product';
//$actionName = $_GET['a'] ?? null;

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";


if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Render());
    //$controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName);
} else {
    echo "404";
}
    
}catch (\PDOException $e) {
    var_dump($e->getMessage());
    (new Session)->destroy();
echo "<br><br><br><br> Некорректные данные для регистрации <br>";
   
}catch (\Exception $e) {
    var_dump($e->getMessage());
}



die();




















