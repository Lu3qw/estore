<?php
require_once(ROOT . '/views/layouts/header.php');
$reviews = Review::getAllReviews();
$products = Product::getAllProducts();
$users = User::getAllUsers();
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Управління відгуками</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Товар</th>
                                <th>Користувач</th>
                                <th>Текст</th>
                                <th>Оцінка</th>
                                <th>Дата</th>
                                <th>Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($reviews as $review): ?>
                            <tr>
                                <td><?= $review['id'] ?></td>
                                <td>
                                    <?php 
                                    $productName = '';
                                    foreach ($products as $product) {
                                        if ($product['id'] == $review['product_id']) {
                                            $productName = htmlspecialchars($product['name']);
                                            break;
                                        }
                                    }
                                    echo $productName;
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($review['user_name']) ?></td>
                                <td><?= htmlspecialchars($review['text']) ?></td>
                                <td><?= $review['rating'] ?></td>
                                <td><?= $review['date'] ?></td>
                                <td>
                                    <a href="/admin/reviews/delete/<?= $review['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Видалити відгук?');"><i class="fa fa-trash"></i> Видалити</a>
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
