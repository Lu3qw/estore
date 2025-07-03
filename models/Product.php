<?php

class Product {

    const SHOW_BY_DEFAULT = 10;

    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT) {

        $db = Db::getConnection();

        $query = "SELECT id, name, price, image, is_new FROM product 
        WHERE status = 1 ORDER BY id DESC LIMIT $count";

        $result = $db->query($query);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public static function getProductsListByCategory($categoryId) {

        $db = Db::getConnection();

        $query = "SELECT id, name, price, image, is_new FROM product 
        WHERE status = 1 AND category_id = $categoryId 
        ORDER BY id DESC LIMIT " . self::SHOW_BY_DEFAULT;

        $result = $db->query($query);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public static function getProductById($id) {

        $db = Db::getConnection();

        $query = "SELECT * FROM product WHERE id = :id AND status = 1";
        
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public static function getAllProducts() {

        $db = Db::getConnection();

        $query = "SELECT id, name, price, image, is_new FROM product 
        WHERE status = 1 ORDER BY id DESC";

        $result = $db->query($query);

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public static function searchProducts($searchTerm) {

        $db = Db::getConnection();

        $query = "SELECT id, name, price, image, is_new FROM product 
        WHERE status = 1 AND (name LIKE :search OR description LIKE :search) 
        ORDER BY id DESC LIMIT " . self::SHOW_BY_DEFAULT;

        $result = $db->prepare($query);
        $searchTerm = '%' . $searchTerm . '%';
        $result->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        $result->execute();

        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

}