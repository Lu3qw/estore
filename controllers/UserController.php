<?php

class UserController {

   public function actionRegister() {

        $name = '';
        $email = '';
        $password = '';
        $errors = [];
        $result = false;

        if (isset($_POST['submit'])) {

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Валідація
            if (strlen($name) < 2) {
                $errors[] = "Ім'я повинно містити мінімум 2 символи";
            }
            if (!User::isEmailValid($email)) {
                $errors[] = "Некоректний email";
            }
            if (!User::isPasswordStrong($password)) {
                $errors[] = "Пароль повинен містити мінімум 6 символів";
            }
            if (!User::isEmailUnique($email)) {
                $errors[] = "Email вже використовується";
            }

            if (empty($errors)) {
                $result = User::register($name, $email, $password);
            }
        }

        require_once ROOT . '/views/user/register.php';

        return true;
    }

     public function actionLogin() {
        $email = '';
        $password = '';
        $result = false;
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = User::checkUserData($email, $password);

            if ($result) {
                // Якщо дані вірні, запам'ятовуємо користувача
                User::auth($result);
                header("Location: /user/profile");
            } else {
                $errors[] = 'Неправильний логін або пароль';
            }
        }
        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    public function actionProfile() {
        $userId = $_SESSION['user'] ?? null;
        if (!$userId) {
            header("Location: /user/login");
            exit();
        }
        
        $user = User::getById($userId);
        
        $orders = Order::getOrdersByUserId($userId);
        
        $favorites = Favorite::getFavorites($userId);
        
        $reviews = Review::getByUserId($userId);
        
        require_once(ROOT . '/views/user/profile.php');
        return true;
    }

   public function actionIndex() {
        if (isset($_SESSION['user'])) {
            header("Location: /user/profile");
            exit;
        } else {
            header("Location: /user/login");
            exit;
        }
    }

    public function actionEdit() {
        $userId = $_SESSION['user'] ?? null;
        if (!$userId) {
            header("Location: /user/login");
            exit;
        }
        if ($_POST) {
            User::update($userId, $_POST['name'], $_POST['email']);
            header("Location: /user/profile");
            exit;
        }
        $user = User::getById($userId);
        require_once(ROOT . '/views/user/edit.php');
        return true;
    }

    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: /");
        exit;
    }
}