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

    // CREATE
    public static function create($name, $category_id, $code, $price, $availability, $brand, $image, $description, $is_new, $is_recommended, $status) {
        $db = Db::getConnection();
        $sql = "INSERT INTO product (name, category_id, code, price, availability, brand, image, description, is_new, is_recommended, status) VALUES (:name, :category_id, :code, :price, :availability, :brand, :image, :description, :is_new, :is_recommended, :status)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':availability', $availability, PDO::PARAM_INT);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':is_new', $is_new, PDO::PARAM_INT);
        $stmt->bindParam(':is_recommended', $is_recommended, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // READ (all)
    public static function getAllProducts() {
        $db = Db::getConnection();
        $query = "SELECT id, name, category_id, code, price, availability, brand, image, description, is_new, is_recommended, status FROM product ORDER BY id DESC";
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // READ (one)
    public static function getProductById($id) {
        $db = Db::getConnection();
        $query = "SELECT id, name, category_id, code, price, availability, brand, image, description, is_new, is_recommended, status FROM product WHERE id = :id";
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // UPDATE
    public static function update($id, $name, $category_id, $code, $price, $availability, $brand, $image, $description, $is_new, $is_recommended, $status) {
        $db = Db::getConnection();
        $sql = "UPDATE product SET name = :name, category_id = :category_id, code = :code, price = :price, availability = :availability, brand = :brand, image = :image, description = :description, is_new = :is_new, is_recommended = :is_recommended, status = :status WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':availability', $availability, PDO::PARAM_INT);
        $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':is_new', $is_new, PDO::PARAM_INT);
        $stmt->bindParam(':is_recommended', $is_recommended, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // DELETE
    public static function delete($id) {
        $db = Db::getConnection();
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}