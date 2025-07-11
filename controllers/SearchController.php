<?php

class SearchController {
    
    public function actionIndex() {
        $searchQuery = $_GET['q'] ?? '';
        $category = $_GET['category'] ?? '';
        $minPrice = $_GET['min_price'] ?? '';
        $maxPrice = $_GET['max_price'] ?? '';
        $sortBy = $_GET['sort'] ?? 'name';
        $sortOrder = $_GET['order'] ?? 'asc';
        
        $categories = Category::getCategoriesList();
        
        $products = [];
        if ($searchQuery || $category || $minPrice || $maxPrice) {
            $products = Product::searchProducts($searchQuery, $category, $minPrice, $maxPrice, $sortBy, $sortOrder);
        }
        
        require_once(ROOT . '/views/search/index.php');
        return true;
    }
    
    public function actionAjax() {
        $searchQuery = $_GET['q'] ?? '';
        
        if (strlen($searchQuery) < 2) {
            echo json_encode([]);
            return;
        }
        
        $products = Product::searchProducts($searchQuery, '', '', '', 'name', 'asc', 5);
        
        $results = [];
        foreach ($products as $product) {
            $results[] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'url' => '/product/' . $product['id']
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode($results);
    }
}