<?php


namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{


    public function actionCatalog() {
        $catalog = Product::getAll();
        $page = $_GET['page'] ?? 0;
       $catalog =Product::getAll();
        

        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard() {
        $id = $_GET['id'];

        $good = Product::getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }



}