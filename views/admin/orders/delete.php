<?php
require_once(ROOT . '/views/layouts/header.php');
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-danger">
                <div class="panel-heading" style="background: #e74c3c; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Видалити товар</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <p>Ви дійсно бажаєте видалити товар <strong><?= htmlspecialchars($product['name']) ?></strong>?</p>
                    <div class="alert alert-warning">
                        <strong>Увага!</strong> Цю дію неможливо скасувати.
                    </div>
                    <form method="post">
                        <button type="submit" class="btn btn-danger">Видалити товар</button>
                        <a href="/admin/products/index" class="btn btn-default">Скасувати</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(ROOT . '/views/layouts/footer.php');
?>