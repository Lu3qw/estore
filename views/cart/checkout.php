<?php include(ROOT . "/views/layouts/header.php") ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Оформлення замовлення</h1>
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <div class="row">
                    <div class="col-sm-8">
                        <h3>Дані для доставки</h3>
                        <form method="post" action="/cart/checkout">
                            <div class="form-group">
                                <label for="name">Ім'я та прізвище *</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Телефон *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Адреса доставки *</label>
                                <textarea class="form-control" id="address" name="address" rows="3" required><?= htmlspecialchars($address) ?></textarea>
                            </div>
                            
                            <button type="submit" name="submit" class="btn btn-success btn-lg">Підтвердити замовлення</button>
                        </form>
                    </div>
                    
                    <div class="col-sm-4">
                        <h3>Ваше замовлення</h3>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php foreach ($cartProducts as $product): ?>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-sm-8">
                                            <strong><?= htmlspecialchars($product['name']) ?></strong><br>
                                            <small>Кількість: <?= $product['quantity'] ?></small>
                                        </div>
                                        <div class="col-sm-4 text-right">
                                            $<?= $product['total_price'] ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <strong>Загальна сума:</strong>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                        <strong>$<?= $totalPrice ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . "/views/layouts/footer.php") ?>