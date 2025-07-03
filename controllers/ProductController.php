<?php

class ProductController {

    public function actionView($productId) {

        $categories = Category::getCategoriesList();
        
        $product = Product::getProductById($productId);
        
        if (!$product) {
            // Якщо товар не знайдено, перенаправляємо на 404
            header('HTTP/1.0 404 Not Found');
            require_once ROOT . '/views/site/404.php';
            return false;
        }

        require_once ROOT . '/views/product/view.php';

        return true;
    }

}