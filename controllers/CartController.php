<?php

class CartController {

    public function actionAdd() {
        
        $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        
        if ($productId <= 0) {
            echo json_encode(['success' => false, 'message' => 'Невірний ID товару']);
            return false;
        }

        $product = Product::getProductById($productId);
        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Товар не знайдено']);
            return false;
        }
        Cart::addProduct($productId, $quantity);
        
        echo json_encode(['success' => true, 'message' => 'Товар додано в кошик']);
        return true;
    }

    public function actionIndex() {
        
        $cartProducts = Cart::getProducts();
        $totalPrice = Cart::getTotalPrice();
        $totalQuantity = Cart::getTotalQuantity();

        require_once ROOT . '/views/cart/index.php';
        return true;
    }

    public function actionUpdate() {
        
        $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        
        if ($productId > 0) {
            Cart::updateProduct($productId, $quantity);
        }
        
        header('Location: /cart');
        return true;
    }

    public function actionRemove() {
        
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($productId > 0) {
            Cart::removeProduct($productId);
        }
        
        header('Location: /cart');
        return true;
    }

    public function actionClear() {
        
        Cart::clear();
        header('Location: /cart');
        return true;
    }

    public function actionCheckout() {
        
        $cartProducts = Cart::getProducts();
        $totalPrice = Cart::getTotalPrice();
        
        if (empty($cartProducts)) {
            header('Location: /cart');
            return false;
        }

        $name = '';
        $email = '';
        $phone = '';
        $address = '';
        $errors = [];

        if (isset($_POST['submit'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);

            // Валідація
            if (empty($name)) {
                $errors[] = 'Введіть ім\'я';
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Введіть коректний email';
            }
            if (empty($phone)) {
                $errors[] = 'Введіть телефон';
            }
            if (empty($address)) {
                $errors[] = 'Введіть адресу';
            }

            if (empty($errors)) {
               
                $orderId = Order::create($name, $email, $phone, $address, $cartProducts, $totalPrice);
                
                if ($orderId) {
                    Cart::clear();
                    header('Location: /cart/success/' . $orderId);
                    return true;
                } else {
                    $errors[] = 'Помилка при створенні замовлення';
                }
            }
        }

        require_once ROOT . '/views/cart/checkout.php';
        return true;
    }

    public function actionSuccess($orderId) {
        
        $order = Order::getOrderById($orderId);
        
        if (!$order) {
            header('Location: /');
            return false;
        }

        require_once ROOT . '/views/cart/success.php';
        return true;
    }

}