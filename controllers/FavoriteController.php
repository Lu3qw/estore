<?php
class FavoriteController {

    public function actionAdd($productId) {
        $userId = $_SESSION['user'] ?? null;
        if ($userId) Favorite::add($userId, $productId);
        header("Location: /product/$productId");
    }
    public function actionRemove($productId) {
        $userId = $_SESSION['user'] ?? null;
        if ($userId) Favorite::remove($userId, $productId);
        header("Location: /user/favorites");
    }
    public function actionIndex() {
        $userId = $_SESSION['user'] ?? null;
        $products = Favorite::getFavorites($userId);
        require_once(ROOT . '/views/user/favorites.php');
    }
}

