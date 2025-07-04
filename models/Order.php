<?php

class Order {

    public static function create($name, $email, $phone, $address, $products, $totalPrice) {
        $db = Db::getConnection();

        $productsJson = json_encode($products);

        $query = "INSERT INTO `order` (user_name, user_email, user_phone, user_address, products, total_price, status, date)
                  VALUES (:user_name, :user_email, :user_phone, :user_address, :products, :total_price, 1, NOW())";

        $result = $db->prepare($query);
        $result->bindParam(':user_name', $name, PDO::PARAM_STR);
        $result->bindParam(':user_email', $email, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $phone, PDO::PARAM_STR);
        $result->bindParam(':user_address', $address, PDO::PARAM_STR);
        $result->bindParam(':products', $productsJson, PDO::PARAM_STR);
        $result->bindParam(':total_price', $totalPrice, PDO::PARAM_STR);

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