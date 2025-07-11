<?php
require_once(ROOT . '/views/layouts/header.php');
$categories = Category::getCategoriesList();
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Управління категоріями</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <a href="/admin/categories/create" class="btn btn-success" style="margin-bottom: 20px;">
                        <i class="fa fa-plus"></i> Додати категорію
                    </a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Назва</th>
                                <th>Порядок</th>
                                <th>Статус</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categories as $cat): ?>
                            <tr>
                                <td><?= $cat['id'] ?></td>
                                <td><?= htmlspecialchars($cat['name']) ?></td>
                                <td><?= $cat['sort_order'] ?></td>
                                <td><?= $cat['status'] ? 'Активна' : 'Неактивна' ?></td>
                                <td>
                                    <a href="/admin/categories/update/<?= $cat['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Редагувати</a>
                                    <a href="/admin/categories/delete/<?= $cat['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Видалити категорію?');"><i class="fa fa-trash"></i> Видалити</a>
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

