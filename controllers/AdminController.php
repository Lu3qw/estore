<?php

class AdminController {

    public function actionIndex() {
        // Головна сторінка адміністратора
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    // === PRODUCTS ===
    public function actionProducts() {
        $products = Product::getAllProducts();
        $categories = Category::getCategoriesList();
        require_once(ROOT . '/views/admin/products/index.php');
        return true;
    }

    public function actionProductsCreate() {
        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $code = $_POST['code'] ?? '';
            $price = $_POST['price'] ?? '';
            $availability = $_POST['availability'] ?? 0;
            $brand = $_POST['brand'] ?? '';
            $image = $_POST['image'] ?? '';
            $description = $_POST['description'] ?? '';
            $is_new = $_POST['is_new'] ?? 0;
            $is_recommended = $_POST['is_recommended'] ?? 0;
            $status = $_POST['status'] ?? 0;

            if (Product::create($name, $category_id, $code, $price, $availability, $brand, $image, $description, $is_new, $is_recommended, $status)) {
                header("Location: /admin/products/index");
                exit;
            }
        }
        $categories = Category::getCategoriesList();
        require_once(ROOT . '/views/admin/products/create.php');
        return true;
    }

    public function actionProductsUpdate($id) {
        $product = Product::getProductById($id);
        if (!$product) {
            header("Location: /admin/products/index");
            exit;
        }

        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $code = $_POST['code'] ?? '';
            $price = $_POST['price'] ?? '';
            $availability = $_POST['availability'] ?? 0;
            $brand = $_POST['brand'] ?? '';
            $image = $_POST['image'] ?? '';
            $description = $_POST['description'] ?? '';
            $is_new = $_POST['is_new'] ?? 0;
            $is_recommended = $_POST['is_recommended'] ?? 0;
            $status = $_POST['status'] ?? 0;

            if (Product::update($id, $name, $category_id, $code, $price, $availability, $brand, $image, $description, $is_new, $is_recommended, $status)) {
                header("Location: /admin/products/index");
                exit;
            }
        }
        $categories = Category::getCategoriesList();
        require_once(ROOT . '/views/admin/products/update.php');
        return true;
    }

    public function actionProductsDelete($id) {
        $product = Product::getProductById($id);
        if (!$product) {
            header("Location: /admin/products/index");
            exit;
        }

        if ($_POST) {
            if (Product::delete($id)) {
                header("Location: /admin/products/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/products/delete.php');
        return true;
    }

    // === CATEGORIES ===
    public function actionCategories() {
        $categories = Category::getCategoriesList();
        require_once(ROOT . '/views/admin/categories/index.php');
        return true;
    }

    public function actionCategoriesCreate() {
        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $sortOrder = $_POST['sort_order'] ?? '';
            $status = $_POST['status'] ?? 0;
            if (Category::create($name, $sortOrder, $status)) {
                header("Location: /admin/categories/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/categories/create.php');
        return true;
    }

    public function actionCategoriesUpdate($id) {
        $category = Category::getById($id);
        if (!$category) {
            header("Location: /admin/categories/index");
            exit;
        }

        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $sortOrder = $_POST['sort_order'] ?? '';
            $status = $_POST['status'] ?? 0;
            if (Category::update($id, $name, $sortOrder, $status)) {
                header("Location: /admin/categories/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/categories/update.php');
        return true;
    }

    public function actionCategoriesDelete($id) {
        $category = Category::getById($id);
        if (!$category) {
            header("Location: /admin/categories/index");
            exit;
        }

        if ($_POST) {
            if (Category::delete($id)) {
                header("Location: /admin/categories/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/categories/delete.php');
        return true;
    }

    // === ORDERS ===
    public function actionOrders() {
        $orders = Order::getAllOrders();
        $users = User::getAllUsers();
        require_once(ROOT . '/views/admin/orders/index.php');
        return true;
    }

    public function actionOrdersView($id) {
        $order = Order::getOrderById($id);
        if (!$order) {
            header("Location: /admin/orders/index");
            exit;
        }
        require_once(ROOT . '/views/admin/orders/view.php');
        return true;
    }

    public function actionOrdersUpdate($id) {
        $order = Order::getOrderById($id);
        if (!$order) {
            header("Location: /admin/orders/index");
            exit;
        }

        if ($_POST) {
            $status = $_POST['status'] ?? 0;
            if (Order::updateStatus($id, $status)) {
                header("Location: /admin/orders/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/orders/update.php');
        return true;
    }

    public function actionOrdersDelete($id) {
        $order = Order::getOrderById($id);
        if (!$order) {
            header("Location: /admin/orders/index");
            exit;
        }

        if ($_POST) {
            if (Order::delete($id)) {
                header("Location: /admin/orders/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/orders/delete.php');
        return true;
    }

    // === USERS ===
    public function actionUser() {
        $users = User::getAllUsers();
        require_once(ROOT . '/views/admin/users/index.php');
        return true;
    }

    public function actionUsersCreate() {
        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (User::isEmailValid($email) && User::isPasswordStrong($password) && User::isEmailUnique($email)) {
                if (User::register($name, $email, $password)) {
                    header("Location: /admin/users/index");
                    exit;
                }
            }
        }
        require_once(ROOT . '/views/admin/users/create.php');
        return true;
    }

    public function actionUsersUpdate($id) {
        $user = User::getById($id);
        if (!$user) {
            header("Location: /admin/users/index");
            exit;
        }

        if ($_POST) {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            if (User::update($id, $name, $email)) {
                header("Location: /admin/users/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/users/update.php');
        return true;
    }

    public function actionUsersDelete($id) {
        $user = User::getById($id);
        if (!$user) {
            header("Location: /admin/users/index");
            exit;
        }

        if ($_POST) {
            if (User::delete($id)) {
                header("Location: /admin/users/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/users/delete.php');
        return true;
    }

    // === REVIEWS ===
    public function actionReviews() {
        $reviews = Review::getAllReviews();
        $products = Product::getAllProducts();
        $users = User::getAllUsers();
        require_once(ROOT . '/views/admin/reviews/index.php');
        return true;
    }

    public function actionReviewsView($id) {
        $review = Review::getById($id);
        if (!$review) {
            header("Location: /admin/reviews/index");
            exit;
        }
        require_once(ROOT . '/views/admin/reviews/view.php');
        return true;
    }

    public function actionReviewsUpdate($id) {
        $review = Review::getById($id);
        if (!$review) {
            header("Location: /admin/reviews/index");
            exit;
        }

        if ($_POST) {
            $text = $_POST['text'] ?? '';
            $rating = $_POST['rating'] ?? 0;
            if (Review::update($id, $text, $rating)) {
                header("Location: /admin/reviews/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/reviews/update.php');
        return true;
    }

    public function actionReviewsDelete($id) {
        $review = Review::getById($id);
        if (!$review) {
            header("Location: /admin/reviews/index");
            exit;
        }

        if ($_POST) {
            if (Review::delete($id)) {
                header("Location: /admin/reviews/index");
                exit;
            }
        }
        require_once(ROOT . '/views/admin/reviews/delete.php');
        return true;
    }
}