<?php

class AdminController {

    public function actionIndex() {
        // Код для відображення головної сторінки адміністратора
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    public function actionProducts() {
        // Код для обробки продуктів адміністратора
        $products = Product::getAllProducts();
        $categories = Category::getCategoriesList();
        require_once(ROOT . '/views/admin/products/index.php');
        return true;
    }

    public function actionOrders() {
        // Код для обробки замовлень адміністратора
        $orders = Order::getAllOrders();
        $users = User::getAllUsers();
        require_once(ROOT . '/views/admin/orders/index.php');
        return true;
    }

    public function actionCategories() {
        // Код для обробки категорій адміністратора
        $categories = Category::getCategoriesList();
        require_once(ROOT . '/views/admin/categories/index.php');
        return true;
    }

    public function actionCategoriesCreate() {
        // Код для створення нової категорії
        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $sortOrder = $_POST['sort_order'] ?? '';
            $status = $_POST['status'] ?? 0;
            if (Category::create($name, $sortOrder, $status)) {
                header("Location: /admin/categories/");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/categories/add.php');
        return true;
    }

    public function actionUsers() {
        // Код для обробки користувачів адміністратора
        $users = User::getAllUsers();
        require_once(ROOT . '/views/admin/users/index.php');
        return true;
    }

    public function actionReviews() {
        // Код для обробки відгуків адміністратора
        $reviews = Review::getAllReviews();
        $products = Product::getAllProducts();
        $users = User::getAllUsers();

        require_once(ROOT . '/views/admin/reviews/index.php');
    }



}
