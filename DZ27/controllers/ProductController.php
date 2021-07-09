<?php


namespace app\controllers;


use app\models\repositories\ProductRepository;
use app\engine\Request;

class ProductController extends Controller
{


    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog() {
        $catalog = (new ProductRepository)->getAll();
        $page = (new Request)->getParams()['page']?? 0;
        $catalog = $catalog = (new ProductRepository)->getLimit(($page + 1) * GOODS_FOR_PAGE);


        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard() {
        //$id = $_GET['id'];
        $id = (new Request)->getParams()['id'];
        $good  = (new ProductRepository)->getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }



}