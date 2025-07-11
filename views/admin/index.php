<?php
require_once(ROOT . '/views/layouts/header.php');
?>

<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Панель адміністратора</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <p>Ласкаво просимо до адміністративної панелі! Оберіть розділ для керування:</p>
                    <ul class="list-group" style="font-size: 18px;">
                        <li class="list-group-item">
                            <a href="/admin/products/index"><i class="fa fa-cube"></i> Товари</a>
                        </li>
                        <li class="list-group-item">
                            <a href="/admin/categories/index"><i class="fa fa-list"></i> Категорії</a>
                        </li>
                        <li class="list-group-item">
                            <a href="/admin/orders/index"><i class="fa fa-shopping-cart"></i> Замовлення</a>
                        </li>
                        <li class="list-group-item">
                            <a href="/admin/users/index"><i class="fa fa-users"></i> Користувачі</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once(ROOT . '/views/layouts/footer.php');
?>
