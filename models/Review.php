<?php

class Review {
    public static function add($productId, $userId, $text, $rating) {
        $db = Db::getConnection();
        $stmt = $db->prepare("INSERT INTO reviews (product_id, user_id, text, rating) VALUES (?, ?, ?, ?)");
        $stmt->execute([$productId, $userId, $text, $rating]);
    }
    public static function getByProduct($productId) {
        $db = Db::getConnection();
       $stmt = $db->prepare("SELECT r.id, r.product_id, r.user_id, r.text, r.rating, r.date, IFNULL(u.name, 'Гість') AS user_name 
                      FROM reviews r 
                      LEFT JOIN user u ON r.user_id = u.id 
                      WHERE r.product_id = ? 
                      ORDER BY r.date DESC");

        $stmt->execute([$productId]);
        return $stmt->fetchAll();
    }

    public static function getByUserId($userId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("SELECT * FROM reviews WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}