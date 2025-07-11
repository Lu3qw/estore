<?php

class ProductController {

    public function actionView($productId) {

        $categories = Category::getCategoriesList();

        $product = Product::getProductById($productId);

        $reviews = Review::getByProduct($product['id']);
        
        if (!$product) {
            // Якщо товар не знайдено, перенаправляємо на 404
            header('HTTP/1.0 404 Not Found');
            require_once ROOT . '/views/site/404.php';
            return false;
        }

        require_once ROOT . '/views/product/view.php';

        return true;
    }

    public function actionSearch() {
        $query = $_GET['query'] ?? '';
        $products = Product::searchProducts($query);
        require_once(ROOT . '/views/catalog/search.php');
    }

    public static function searchProducts($searchQuery = '', $category = '', $minPrice = '', $maxPrice = '', $sortBy = 'name', $sortOrder = 'asc', $limit = null) {
        $db = Db::getConnection();
        
        $sql = "SELECT p.*, c.name as category_name FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id WHERE 1=1";
        
        $params = [];
  
        if (!empty($searchQuery)) {
            $sql .= " AND (p.name LIKE ? OR p.description LIKE ?)";
            $params[] = '%' . $searchQuery . '%';
            $params[] = '%' . $searchQuery . '%';
        }

        if (!empty($category)) {
            $sql .= " AND p.category_id = ?";
            $params[] = $category;
        }

        if (!empty($minPrice) && is_numeric($minPrice)) {
            $sql .= " AND p.price >= ?";
            $params[] = $minPrice;
        }
        
        if (!empty($maxPrice) && is_numeric($maxPrice)) {
            $sql .= " AND p.price <= ?";
            $params[] = $maxPrice;
        }
        
        $sql .= " AND p.status = 1";
        
        $allowedSortColumns = ['name', 'price', 'created_at', 'id'];
        $allowedSortOrders = ['asc', 'desc'];
        
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'name';
        }
        
        if (!in_array($sortOrder, $allowedSortOrders)) {
            $sortOrder = 'asc';
        }
        
        $sql .= " ORDER BY p.$sortBy $sortOrder";
        
        
        if ($limit && is_numeric($limit)) {
            $sql .= " LIMIT ?";
            $params[] = (int)$limit;
        }
        
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getPopularSearchTerms($limit = 10) {
        $db = Db::getConnection();
        
        $sql = "SELECT name FROM products 
                WHERE status = 1 
                ORDER BY RAND() 
                LIMIT ?";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([$limit]);
        
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public static function getPriceRange() {
        $db = Db::getConnection();
        
        $sql = "SELECT MIN(price) as min_price, MAX(price) as max_price FROM products WHERE status = 1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}