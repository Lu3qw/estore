<?php
require_once(ROOT . '/views/layouts/header.php');
$products = json_decode($order['products'], true);
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Замовлення #<?= $order['id'] ?></h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Інформація про замовлення</h4>
                            <p><strong>Дата:</strong> <?= date('d.m.Y H:i', strtotime($order['date'])) ?></p>
                            <p><strong>Статус:</strong> 
                                <?php
                                $status = $order['status'] ?? 0;
                                switch ($status) {
                                    case 0:
                                        echo '<span class="label label-warning">Нове</span>';
                                        break;
                                    case 1:
                                        echo '<span class="label label-info">В обробці</span>';
                                        break;
                                    case 2:
                                        echo '<span class="label label-success">Виконано</span>';
                                        break;
                                    case 3:
                                        echo '<span class="label label-danger">Скасовано</span>';
                                        break;
                                    default:
                                        echo '<span class="label label-default">Невідомий статус</span>';
                                        break;
                                }
                                ?>
                            </p>
                            <p><strong>Клієнт:</strong> <?= htmlspecialchars($order['user_name']) ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($order['user_email']) ?></p>
                            <p><strong>Телефон:</strong> <?= htmlspecialchars($order['user_phone']) ?></p>
                            <p><strong>Адреса:</strong> <?= htmlspecialchars($order['user_address']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4>Продукти в замовленні</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Назва</th>
                                        <th>Код</th>
                                        <th>Кількість</th>
                                        <th>Ціна</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($product['name']) ?></td>
                                            <td><?= htmlspecialchars($product['code']) ?></td>
                                            <td><?= $product['quantity'] ?></td>
                                            <td><?= number_format($product['price'], 2, '.', '') ?> грн</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <h4>Загальна сума: <?= number_format($order['total'], 2, '.', '') ?> грн</h4>
                        </div>
                    </div>
                    <div class="text-center" style="margin-top: 20px;">
                        <a href="/admin/orders/index" class="btn btn-default">Повернутися до списку замовлень</a>
                        <?php if ($status == 0): ?>
                            <a href="/admin/orders/update/<?= $order['id'] ?>" class="btn btn-primary">Редагувати замовлення</a>
                        <?php endif; ?>
                        <a href="/admin/orders/delete/<?= $order['id'] ?>" class="btn btn-danger">Видалити замовлення</a>
                        <?php if ($status == 0): ?>
                            <a href="/admin/orders/confirm/<?= $order['id'] ?>" class="btn btn-success">Підтвердити замовлення</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(ROOT . '/views/layouts/footer.php');
?>