<?php


class SiteController {

    public function actionIndex() {


        $categories = Category::getCategoriesList();

        $latestProducts = Product::getLatestProducts();


        require_once ROOT . '/views/site/index.php';

        return true;
    }

    public function actionAbout() {
        require_once ROOT . '/views/site/about.php';
        return true;
    }

    public function actionContact() {
        require_once ROOT . '/views/site/contact.php';
        return true;
    }

}