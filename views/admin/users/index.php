<?php
require_once(ROOT . '/views/layouts/header.php');
$users = User::getAllUsers();
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Управління користувачами</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <a href="/admin/users/create" class="btn btn-success" style="margin-bottom: 20px;">
                        <i class="fa fa-plus"></i> Додати користувача
                    </a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ім'я</th>
                                <th>Email</th>
                                <th>Роль</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= htmlspecialchars($user['name']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= isset($user['role']) ? htmlspecialchars($user['role']) : 'user' ?></td>
                                <td>
                                    <a href="/admin/users/update/<?= $user['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Редагувати</a>
                                    <a href="/admin/users/delete/<?= $user['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Видалити користувача?');"><i class="fa fa-trash"></i> Видалити</a>
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
