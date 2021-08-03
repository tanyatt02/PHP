<?php


namespace app\controllers;



use app\engine\App;

class ProductController extends Controller
{


    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog() {
        $catalog = App::call()->productRepository->getAll();
        $page = App::call()->request->getParams()['page']?? 0;
        $catalog = $catalog = App::call()->productRepository->getLimit(($page + 1) * App::call()->config['product_per_page']);


        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard() {
        //$id = $_GET['id'];
        $id = App::call()->request->getParams()['id'];
        $good  = App::call()->productRepository->getOne($id);

        echo $this->render('card', [
            'good' => $good
        ]);
    }



}