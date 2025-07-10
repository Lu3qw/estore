<?php

Class User {

    public static function register($name, $email, $password) {
        $db = Db::getConnection();
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $passwordHash, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function isEmailValid($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isPasswordStrong($password) {
        return strlen($password) >= 6;
    }

    public static function isEmailUnique($email) {
        $db = Db::getConnection();
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        return $result->fetchColumn() == 0;
    }

    public static function checkUserData($email, $password) {
        $db = Db::getConnection();
        $sql = "SELECT * FROM user WHERE email = :email";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    public static function auth($userId) {
        $_SESSION['user'] = $userId;
    }

    public static function getById($id) {
        $db = Db::getConnection();
        $sql = "SELECT * FROM user WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $name, $email) {
        $db = Db::getConnection();
        $sql = "UPDATE user SET name = :name, email = :email WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}