<?php

class Order {

    public static function create($userName, $userPhone, $userComment, $products, $userId = null) {
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO `order` (user_name, user_phone, user_comment, products, user_id) 
                VALUES (:user_name, :user_phone, :user_comment, :products, :user_id)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':products', json_encode($products), PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return false;
    }

    public static function getOrderById($orderId) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM `order` WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $orderId, PDO::PARAM_INT);
        $result->execute();
        
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllOrders() {
        $db = Db::getConnection();

        $query = "SELECT * FROM `order` ORDER BY date DESC";
        $result = $db->query($query);

        $orders = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($orders as &$order) {
            if (isset($order['products'])) {
                $order['products'] = json_decode($order['products'], true);
            }
        }

        return $orders;
    }

    public static function getOrdersByUserId($userId) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM `order` WHERE user_id = :user_id ORDER BY date DESC';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->execute();
        
        $orders = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $orders[] = $row;
        }
        
        return $orders;
    }

    public static function updateStatus($orderId, $status) {
        $db = Db::getConnection();

        $query = "UPDATE `order` SET status = :status WHERE id = :id";
        $result = $db->prepare($query);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':id', $orderId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function delete($orderId) {
        $db = Db::getConnection();

        $query = "DELETE FROM `order` WHERE id = :id";
        $result = $db->prepare($query);
        $result->bindParam(':id', $orderId, PDO::PARAM_INT);

        return $result->execute();
    }
}