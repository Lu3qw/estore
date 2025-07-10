<?php

class Favorite {
    public static function add($userId, $productId) {
        $db = Db::getConnection();
        $db->query("INSERT IGNORE INTO favorites (user_id, product_id) VALUES ($userId, $productId)");
    }
    public static function remove($userId, $productId) {
        $db = Db::getConnection();
        $db->query("DELETE FROM favorites WHERE user_id = $userId AND product_id = $productId");
    }
    public static function getFavorites($userId) {
        $db = Db::getConnection();
        return $db->query("SELECT p.* FROM products p JOIN favorites f ON p.id = f.product_id WHERE f.user_id = $userId")->fetchAll();
    }
}