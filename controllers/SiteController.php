<?php


class SiteController {

    public function actionIndex() {


        $categories = Category::getCategoriesList();

        $latestProducts = Product::getLatestProducts();


        require_once ROOT . '/views/site/index.php';

        return true;
    }

}