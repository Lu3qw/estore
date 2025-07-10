<?php

class Review {
    public static function add($productId, $userId, $text, $rating) {
        $db = Db::getConnection();
        $stmt = $db->prepare("INSERT INTO reviews (product_id, user_id, text, rating) VALUES (?, ?, ?, ?)");
        $stmt->execute([$productId, $userId, $text, $rating]);
    }
    public static function getByProduct($productId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("SELECT * FROM reviews WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchAll();
    }
}