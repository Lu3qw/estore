<?php
class FavoriteController {

    public function actionAdd($productId) {
        $userId = $_SESSION['user'] ?? null;
        if ($userId) {
            Favorite::add($userId, $productId);
        }
        header("Location: /product/$productId");
        exit();
    }
    
    public function actionRemove($productId) {
        $userId = $_SESSION['user'] ?? null;
        if ($userId) {
            Favorite::remove($userId, $productId);
        }
        header("Location: /user/profile");
        exit();
    }
    
    public function actionIndex() {
        $userId = $_SESSION['user'] ?? null;
        if (!$userId) {
            header("Location: /user/login");
            exit();
        }
        
        $products = Favorite::getFavorites($userId);
        require_once(ROOT . '/views/user/favorites.php');
        return true;
    }
}