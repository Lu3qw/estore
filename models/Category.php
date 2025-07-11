<?php

class Category {

    // CREATE
    public static function create($name, $sort_order, $status) {
        $db = Db::getConnection();
        $sql = "INSERT INTO category (name, sort_order, status) VALUES (:name, :sort_order, :status)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // READ (all)
    public static function getCategoriesList() {
        $db = Db::getConnection();
        $query = "SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC";
        $result = $db->query($query);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // READ (one)
    public static function getById($id) {
        $db = Db::getConnection();
        $sql = "SELECT id, name, sort_order, status FROM category WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public static function update($id, $name, $sort_order, $status) {
        $db = Db::getConnection();
        $sql = "UPDATE category SET name = :name, sort_order = :sort_order, status = :status WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // DELETE
    public static function delete($id) {
        $db = Db::getConnection();
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}