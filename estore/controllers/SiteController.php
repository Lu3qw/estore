<?php

class SiteController
{
    public function actionIndex()
    {
        // Logic to display the main page
        $categories = $this->getCategories();
        $latestProducts = $this->getLatestProducts();
        
        require_once(ROOT . '/views/site/index.php');
    }

    public function action404()
    {
        // Logic to display the 404 error page
        require_once(ROOT . '/views/site/404.php');
    }

    private function getCategories()
    {
        // Logic to fetch categories from the database
        // This is a placeholder for actual implementation
        return [];
    }

    private function getLatestProducts()
    {
        // Logic to fetch latest products from the database
        // This is a placeholder for actual implementation
        return [];
    }
}