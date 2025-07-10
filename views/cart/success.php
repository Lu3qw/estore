<?php include(ROOT . "/views/layouts/header.php") ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success">
                    <h1><i class="fa fa-check-circle"></i> Замовлення успішно оформлено!</h1>
                    <p>Дякуємо за ваше замовлення. Ми зв'яжемося з вами найближчим часом.</p>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Деталі замовлення #<?= $order['id'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Контактна інформація</h4>
                                <p><strong>Ім'я:</strong> <?= htmlspecialchars($order['user_name']) ?></p>
                                <p><strong>Телефон:</strong> <?= htmlspecialchars($order['user_phone']) ?></p>
                                <p><strong>Адреса:</strong> <?= htmlspecialchars($order['user_comment']) ?></p>
                                <p><strong>Дата замовлення:</strong> <?= $order['date'] ?></p>
                            </div>
                            <div class="col-sm-6">
                                <h4>Товари</h4>
                                <?php 
                                $products = [];
                                $total = 0;
                                if (!empty($order['products'])) {
                                    if (is_string($order['products'])) {
                                        $decoded = json_decode($order['products'], true);
                                        if (is_array($decoded)) {
                                            $products = $decoded;
                                        }
                                    } elseif (is_array($order['products'])) {
                                        $products = $order['products'];
                                    }
                                    // If products is not array after decode, leave as empty array to avoid foreach error
                                }
                                ?>
                                <?php if (!empty($products) && is_array($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <div class="row" style="margin-bottom: 10px;">
                                            <div class="col-sm-8">
                                                <strong><?= htmlspecialchars($product['name']) ?></strong><br>
                                                <small>Кількість: <?= $product['quantity'] ?></small>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                $<?= isset($product['total_price']) ? $product['total_price'] : ($product['price'] * $product['quantity']) ?>
                                            </div>
                                        </div>
                                        <?php $total += isset($product['total_price']) ? $product['total_price'] : ($product['price'] * $product['quantity']); ?>
                                    <?php endforeach; ?>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <strong>Загальна сума:</strong>
                                        </div>
                                        <div class="col-sm-4 text-right">
                                            <strong>$<?= $total ?></strong>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <a href="/" class="btn btn-primary">Повернутися на головну</a>
                    <a href="/catalog" class="btn btn-primary">Продовжити покупки</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . "/views/layouts/footer.php") ?>