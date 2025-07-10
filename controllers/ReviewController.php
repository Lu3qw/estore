<?php

class ReviewController {

    public function actionAdd($productId) {
        $userId = $_SESSION['user'] ?? null;
        if ($userId && $_POST) {
            Review::add($productId, $userId, $_POST['text'], $_POST['rating']);
        }
        header("Location: /product/$productId");
        return true;
    }

    
}