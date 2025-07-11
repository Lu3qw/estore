<?php

class Favorite {
    public static function add($userId, $productId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("INSERT IGNORE INTO favorites (user_id, product_id) VALUES (?, ?)");
        $stmt->execute([$userId, $productId]);
    }
    
    public static function remove($userId, $productId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("DELETE FROM favorites WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$userId, $productId]);
    }
    
    public static function getFavorites($userId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("SELECT p.* FROM product p JOIN favorites f ON p.id = f.product_id WHERE f.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function isFavorite($userId, $productId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM favorites WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$userId, $productId]);
        return $stmt->fetchColumn() > 0;
    }
}