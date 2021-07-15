<?php

use app\engine\Db;
use app\engine\Request;
use app\engine\Session;
use app\engine\Cookies;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\models\repositories\OrderRepository;

//define('ROOT', dirname(__DIR__));
//define('DS', DIRECTORY_SEPARATOR);
//define('CONTROLLER_NAMESPACE', 'app\\controllers\\');
//define('MODEL_NAMESPACE', 'app\\model\\');
//define("VIEWS_DIR", '../views/');
//define('GOODS_FOR_PAGE',4);

return [
    'root' => dirname(__DIR__),
    'controllers_namespaces' => 'app\\controllers\\',
    'product_per_page' => 2,
    'views_dir' => dirname(__DIR__) . "/views/",
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost:3307',
            'login' => 'root',
            'password' => '',
            'database' => 'testing_newshop',
            'charset' => 'utf8'
        ],
        'request' => [
            'class' => Request::class
        ],
        'basketRepository' => [
            'class' => BasketRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ],
        'statusBasketRepository' => [
            'class' => statusBasketRepository::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ],
        'session' => [
            'class' => Session::class
        ],
        'cookies' => [
            'class' => Cookies::class
        ]
    ]

];

