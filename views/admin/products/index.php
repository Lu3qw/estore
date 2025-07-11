<?php
require_once(ROOT . '/views/layouts/header.php');
$products = Product::getAllProducts();
$categories = Category::getCategoriesList();
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Управління товарами</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <a href="/admin/products/create" class="btn btn-success" style="margin-bottom: 20px;">
                        <i class="fa fa-plus"></i> Додати товар
                    </a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Назва</th>
                                <th>Категорія</th>
                                <th>Код</th>
                                <th>Ціна</th>
                                <th>Наявність</th>
                                <th>Бренд</th>
                                <th>Новий</th>
                                <th>Рекомендований</th>
                                <th>Статус</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td>
                                    <?php 
                                    $catName = '';
                                    foreach ($categories as $cat) {
                                        if ($cat['id'] == $product['category_id']) {
                                            $catName = htmlspecialchars($cat['name']);
                                            break;
                                        }
                                    }
                                    echo $catName;
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($product['code']) ?></td>
                                <td>$<?= $product['price'] ?></td>
                                <td><?= $product['availability'] ? 'Так' : 'Ні' ?></td>
                                <td><?= htmlspecialchars($product['brand']) ?></td>
                                <td><?= $product['is_new'] ? 'Так' : 'Ні' ?></td>
                                <td><?= $product['is_recommended'] ? 'Так' : 'Ні' ?></td>
                                <td><?= $product['status'] ? 'Активний' : 'Неактивний' ?></td>
                                <td>
                                    <a href="/admin/products/update/<?= $product['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Редагувати</a>
                                    <a href="/admin/products/delete/<?= $product['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Видалити товар?');"><i class="fa fa-trash"></i> Видалити</a>
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

