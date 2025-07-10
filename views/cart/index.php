<?php include(ROOT . "/views/layouts/header.php") ?>

<section id="cart_items">
    <div class="container">
        <div class="table-responsive cart_info">
            <?php if (empty($cartProducts)): ?>
                <div class="alert alert-info">
                    <h4>Ваш кошик порожній</h4>
                    <p>Додайте товари з <a href="/catalog">каталогу</a></p>
                </div>
            <?php else: ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Товар</td>
                            <td class="description">Опис</td>
                            <td class="price">Ціна</td>
                            <td class="quantity">Кількість</td>
                            <td class="total">Загалом</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartProducts as $product): ?>
                            <tr>
                                <td class="cart_product">
                                    <a href="/product/<?= $product['id'] ?>">
                                        <img src="<?= $product['image'] ? '/template/images/products/' . $product['image'] : '/template/images/home/product1.jpg' ?>" 
                                             alt="<?= htmlspecialchars($product['name']) ?>" 
                                             style="width:100px;height:auto;">
                                    </a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="/product/<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></a></h4>
                                    <p>ID: <?= $product['id'] ?></p>
                                </td>
                                <td class="cart_price">
                                    <p>$<?= $product['price'] ?></p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <form method="post" action="/cart/update" style="display:flex;gap:5px;">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <input class="cart_quantity_input" type="number" name="quantity" value="<?= $product['quantity'] ?>" min="1">
                                            <button type="submit" class="btn btn-sm" style="background:#a259e6;color:#fff;">Оновити</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">$<?= $product['total_price'] ?></p>
                                </td>
                                <td class="cart_delete">
                                    <form method="post" action="/cart/remove" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <button type="submit" class="cart_quantity_delete" onclick="return confirm('Видалити цей товар з кошика?');" style="background:none;border:none;padding:0;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <table class="table table-condensed total-result" style="width:auto; margin-left:0;">
                    <tr>
                        <td style="padding-right:10px;">Загальна сума</td>
                        <td><span>$<?= $totalPrice ?></span></td>
                    </tr>
                </table>

                <div style="margin-top:20px;">
                    <a href="/cart/clear" class="btn btn-warning" style="background:#a259e6;border:0;color:#fff;">Очистити кошик</a>
                    <a href="/cart/checkout" class="btn btn-success" style="background:#a259e6;border:0;">Оформити замовлення</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include(ROOT . "/views/layouts/footer.php") ?>
