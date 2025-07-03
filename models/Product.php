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


}