<?php

class Order {

    public static function create($name, $phone, $address, $products, $totalPrice, $userId = null) {
        $db = Db::getConnection();

        if (is_array($address)) {
            $address = implode(", ", $address);
        }

        $productsJson = json_encode($products);

        $query = "INSERT INTO `order` (user_name, user_phone, user_comment, products, user_id, date, status)
                  VALUES (:user_name, :user_phone, :user_comment, :products, :user_id, NOW(), 1)";

        $result = $db->prepare($query);
        $result->bindParam(':user_name', $name, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $phone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $address, PDO::PARAM_STR);
        $result->bindParam(':products', $productsJson, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return false;
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

    public static function getOrdersByUserId($userId) {
        $db = Db::getConnection();
        $query = "SELECT * FROM `order` WHERE user_id = :user_id ORDER BY date DESC";
        $result = $db->prepare($query);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->execute();
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