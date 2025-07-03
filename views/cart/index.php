<?php include(ROOT . "/views/layouts/header.php") ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Кошик</h1>
                
                <?php if (empty($cartProducts)): ?>
                    <div class="alert alert-info">
                        <h4>Ваш кошик порожній</h4>
                        <p>Додайте товари з <a href="/catalog">каталогу</a></p>
                    </div>
                <?php else: ?>
                    
                    <div class="table-responsive cart_info">
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
                                                     style="width: 110px; height: 110px; object-fit: cover;">
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
                                                <form method="post" action="/cart/update" style="display: inline;">
                                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                    <input class="cart_quantity_input" type="number" name="quantity" value="<?= $product['quantity'] ?>" min="1" style="width: 60px;">
                                                    <button type="submit" class="btn btn-sm btn-primary">Оновити</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">$<?= $product['total_price'] ?></p>
                                                                                    <td class="cart_total">
                                            <p class="cart_total_price">$<?= $product['total_price'] ?></p>
                                        </td>
                                        <td class="cart_delete">
                                            <form method="post" action="/cart/delete" style="display: inline;">
                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-summary">
                        <h3>Всього: $<?= $totalPrice ?></h3>
                        <a href="/checkout" class="btn btn-success btn-lg">Оформити замовлення</a>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . "/views/layouts/footer.php") ?>
                                            