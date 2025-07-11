<?php

class Review {
    // CREATE
    public static function add($productId, $userId, $text, $rating) {
        $db = Db::getConnection();
        $stmt = $db->prepare("INSERT INTO reviews (product_id, user_id, text, rating) VALUES (?, ?, ?, ?)");
        $stmt->execute([$productId, $userId, $text, $rating]);
        return $db->lastInsertId();
    }

    // READ (all by product)
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

    // READ (one)
    public static function getById($id) {
        $db = Db::getConnection();
        $stmt = $db->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ (all by user)
    public static function getByUserId($userId) {
        $db = Db::getConnection();
        $stmt = $db->prepare("SELECT * FROM reviews WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    // UPDATE
    public static function update($id, $text, $rating) {
        $db = Db::getConnection();
        $stmt = $db->prepare("UPDATE reviews SET text = ?, rating = ? WHERE id = ?");
        return $stmt->execute([$text, $rating, $id]);
    }

    // DELETE
    public static function delete($id) {
        $db = Db::getConnection();
        $stmt = $db->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // GET all reviews
    public static function getAllReviews() {
        $db = Db::getConnection();
        $stmt = $db->query("SELECT r.id, r.product_id, r.user_id, r.text, r.rating, r.date, IFNULL(u.name, 'Гість') AS user_name 
                            FROM reviews r 
                            LEFT JOIN user u ON r.user_id = u.id 
                            ORDER BY r.date DESC");
        return $stmt->fetchAll();
    }
}