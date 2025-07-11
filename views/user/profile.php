<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Профіль</h3>
                    </div>
                    <div class="list-group">
                        <a href="#favorites" class="list-group-item"><i class="fa fa-heart"></i> Улюблені товари</a>
                        <a href="#orders" class="list-group-item"><i class="fa fa-shopping-bag"></i> Мої замовлення</a>
                        <a href="#reviews" class="list-group-item"><i class="fa fa-comments"></i> Мої відгуки</a>
                        <a href="/user/edit" class="list-group-item"><i class="fa fa-pencil"></i> Редагувати профіль</a>
                        <a href="/user/logout" class="list-group-item text-danger"><i class="fa fa-sign-out"></i> Вийти</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <h2 class="title text-center">Профіль користувача</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Ім'я:</th>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                    <tr>
                        <th>Роль:</th>
                        <td><?= htmlspecialchars($user['role'] ?? 'user') ?></td>
                    </tr>
                </table>

                <div id="orders" class="well">
                    <h3><i class="fa fa-shopping-bag"></i> Мої замовлення</h3>
                    <div class="row">
                        <?php if (!empty($orders) && is_array($orders)): ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Дата</th>
                                        <th>Сума</th>
                                        <th>Статус</th>
                                        <th>Товари</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
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
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $order['id'] ?></td>
                                            <td><?= $order['date'] ?></td>
                                            <td>
                                                <?php 
                                                if (!empty($products) && is_array($products)) {
                                                    foreach ($products as $product) {
                                                        $total += isset($product['total_price']) ? $product['total_price'] : ((isset($product['price']) && isset($product['quantity'])) ? $product['price'] * $product['quantity'] : 0);
                                                    }
                                                }
                                                ?>
                                                $<?= $total ?>
                                            </td>
                                            <td><?= $order['status'] == 1 ? 'Новий' : 'Виконано' ?></td>
                                            <td>
                                                <?php if (!empty($products) && is_array($products)): ?>
                                                    <ul style="margin:0; padding-left:18px;">
                                                        <?php foreach ($products as $product): ?>
                                                            <li><?= htmlspecialchars($product['name'] ?? ('Товар #' . ($product['id'] ?? ''))) ?> (x<?= $product['quantity'] ?? '?' ?>)</li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Ви ще не робили замовлень.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div id="favorites" class="well">
                    <h3><i class="fa fa-heart"></i> Улюблені товари</h3>
                    <div class="row">
                        <?php if (!empty($favorites) && is_array($favorites)): ?>
                            <?php foreach ($favorites as $favorite): ?>
                                <div class="col-sm-4" style="margin-bottom:20px;">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center">
                                            <img src="<?= $favorite['image'] ? '/template/images/products/' . $favorite['image'] : '/template/images/product-details/1.jpg' ?>" 
                                                 alt="<?= htmlspecialchars($favorite['name']) ?>" 
                                                 style="width: 150px; height: 150px; object-fit: cover; margin-bottom: 10px;">
                                            <h5><?= htmlspecialchars($favorite['name']) ?></h5>
                                            <p>$<?= $favorite['price'] ?></p>
                                            <div class="btn-group d-flex justify-content-center" role="group" style="display: flex; width: 100%;">
                                                <a href="/product/<?= $favorite['id'] ?>" class="btn btn-warning btn-sm" title="Переглянути" style="border-radius: 0; flex:1; display:flex; align-items:center; justify-content:center;">
                                                    <i class="fa fa-eye"></i> <span style="margin-left:5px;">Переглянути</span>
                                                </a>
                                                <a href="/favorite/remove/<?= $favorite['id'] ?>" class="btn btn-danger btn-sm" title="Видалити з обраного" style="border-radius: 0; border-left: 1px solid #fff; flex:1; display:flex; align-items:center; justify-content:center;" onclick="return confirm('Видалити з обраного?')">
                                                    <i class="fa fa-trash"></i> <span style="margin-left:5px;">Видалити</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>У вас ще немає улюблених товарів.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div id="reviews" class="well">
                    <h3><i class="fa fa-comments"></i> Мої відгуки</h3>
                    <div class="row">
                        <?php if (!empty($reviews) && is_array($reviews)): ?>
                            <?php foreach ($reviews as $review): ?>
                                <div class="panel panel-default" style="margin-bottom:15px;">
                                    <div class="panel-heading">
                                        <strong>Товар ID: <?= $review['product_id'] ?></strong>
                                        <span class="text-muted" style="font-size:0.9em;float:right;">
                                            <?= $review['date'] ? date('d.m.Y H:i', strtotime($review['date'])) : '' ?>
                                        </span>
                                        <?php if (!empty($review['rating'])): ?>
                                            <div style="margin-top:5px;">
                                                Оцінка: 
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <span style="color:<?= $i <= $review['rating'] ? '#FFD700' : '#ccc' ?>;">&#9733;</span>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-body">
                                        <?= nl2br(htmlspecialchars($review['text'])) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Ви ще не залишали відгуків.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>