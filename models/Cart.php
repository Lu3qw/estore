<?php

class Cart {

    public static function addProduct($productId, $quantity = 1) {
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        return true;
    }

    public static function removeProduct($productId) {
        
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        return true;
    }

    public static function updateProduct($productId, $quantity) {
        
        if (isset($_SESSION['cart'][$productId])) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$productId]);
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
        }

        return true;
    }

    public static function getProducts() {
        
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            return [];
        }

        $products = [];
        $db = Db::getConnection();

        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $query = "SELECT * FROM product WHERE id = :id AND status = 1";
            $result = $db->prepare($query);
            $result->bindParam(':id', $productId, PDO::PARAM_INT);
            $result->execute();

            $product = $result->fetch(PDO::FETCH_ASSOC);
            
            if ($product) {
                $product['quantity'] = $quantity;
                $product['total_price'] = $product['price'] * $quantity;
                $products[] = $product;
            }
        }

        return $products;
    }

    public static function getTotalPrice() {
        
        $products = self::getProducts();
        $totalPrice = 0;

        foreach ($products as $product) {
            $totalPrice += $product['total_price'];
        }

        return $totalPrice;
    }

    public static function getTotalQuantity() {
        
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            return 0;
        }

        $totalQuantity = 0;
        foreach ($_SESSION['cart'] as $quantity) {
            $totalQuantity += $quantity;
        }

        return $totalQuantity;
    }

    public static function clear() {
        
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        return true;
    }

    public static function isEmpty() {
        
        return empty($_SESSION['cart']);
    }

}