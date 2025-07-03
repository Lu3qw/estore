<?php

class Order {

    public static function create($userName, $userPhone, $userComment, $userId, $products) {
        $db = Db::getConnection();

        $productsJson = json_encode($products);

        $query = "INSERT INTO `order` (user_name, user_phone, user_comment, user_id, products, status, date)
                  VALUES (:user_name, :user_phone, :user_comment, :user_id, :products, 1, NOW())";

        $result = $db->prepare($query);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':products', $productsJson, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getOrderById($orderId) {
        $db = Db::getConnection();

        $query = "SELECT * FROM `order` WHERE id = :id";
        $result = $db->prepare($query);
        $result->bindParam(':id', $orderId, PDO::PARAM_INT);
        $result->execute();

        $order = $result->fetch(PDO::FETCH_ASSOC);

        if ($order && isset($order['products'])) {
            $order['products'] = json_decode($order['products'], true);
        }

        return $order;
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