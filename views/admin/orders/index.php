<?php
require_once(ROOT . '/views/layouts/header.php');
$orders = Order::getAllOrders();
$users = User::getAllUsers();
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Управління замовленнями</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Користувач</th>
                                <th>Телефон</th>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th>Сума</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td>
                                    <?php
                                    $userName = '';
                                    if (!empty($order['user_id'])) {
                                        foreach ($users as $user) {
                                            if ($user['id'] == $order['user_id']) {
                                                $userName = htmlspecialchars($user['name']);
                                                break;
                                            }
                                        }
                                    }
                                    echo $userName ? $userName : htmlspecialchars($order['user_name']);
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($order['user_phone']) ?></td>
                                <td><?= !empty($order['date']) ? date('d.m.Y H:i', strtotime($order['date'])) : '' ?></td>
                                <td>
                                    <?php
                                    $statuses = [0 => 'Нове', 1 => 'В обробці', 2 => 'Виконано', 3 => 'Скасовано'];
                                    echo isset($statuses[$order['status']]) ? $statuses[$order['status']] : 'Невідомо';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Підрахунок суми
                                    $total = 0;
                                    if (!empty($order['products']) && is_array($order['products'])) {
                                        foreach ($order['products'] as $prod) {
                                            if (isset($prod['price']) && isset($prod['quantity'])) {
                                                $total += $prod['price'] * $prod['quantity'];
                                            }
                                        }
                                    }
                                    echo '$' . $total;
                                    ?>
                                </td>
                                <td>
                                    <a href="/admin/orders/view/<?= $order['id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Переглянути</a>
                                    <a href="/admin/orders/update/<?= $order['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Редагувати</a>
                                    <a href="/admin/orders/delete/<?= $order['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Видалити замовлення?');"><i class="fa fa-trash"></i> Видалити</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(ROOT . '/views/layouts/footer.php');
?>
