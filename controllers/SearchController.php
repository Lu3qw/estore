<?php

class SearchController {
    
    public function actionIndex() {
        $searchQuery = $_GET['q'] ?? '';
        $category = $_GET['category'] ?? '';
        $minPrice = $_GET['min_price'] ?? '';
        $maxPrice = $_GET['max_price'] ?? '';
        $sortBy = $_GET['sort'] ?? 'name';
        $sortOrder = $_GET['order'] ?? 'asc';
        
        // Отримання списку категорій
        $categories = Category::getCategoriesList();
        
        $products = [];
        
        // Виконуємо пошук навіть якщо є лише один критерій
        if (!empty($searchQuery) || !empty($category) || !empty($minPrice) || !empty($maxPrice)) {
            $products = Product::searchProducts($searchQuery, $category, $minPrice, $maxPrice, $sortBy, $sortOrder);
        }
        
        // Підключаємо вид
        require_once(ROOT . '/views/search/index.php');
        return true;
    }
    
    public function actionAjax() {
        // Встановлюємо правильний Content-Type
        header('Content-Type: application/json');
        
        $searchQuery = $_GET['q'] ?? '';
        
        // Перевіряємо мінімальну довжину запиту
        if (strlen(trim($searchQuery)) < 2) {
            echo json_encode([]);
            exit;
        }
        
        try {
            // Отримуємо результати пошуку
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
            
            echo json_encode($results);
        } catch (Exception $e) {
            // Логування помилки
            error_log("Search AJAX error: " . $e->getMessage());
            echo json_encode([]);
        }
        
        exit; // Важливо завершити виконання
    }
}