<?php include(ROOT . "/views/layouts/header.php") ?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <div class="panel-group category-products">
                                
                                <?php foreach($categories as $categoryItem): ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="<?php if($categoryItem['id'] == $product['category_id']) echo 'active' ?>" href="/category/<?= $categoryItem['id'] ?>"><?= $categoryItem['name'] ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="view-product">
                                        <img src="<?= $product['image'] ? '/template/images/products/' . $product['image'] : '/template/images/product-details/1.jpg' ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="product-information"><!--/product-information-->
                                        <?php if($product['is_new']): ?>
                                            <img src="/template/images/product-details/new.jpg" class="newarrival" alt="new" />
                                        <?php endif ?>
                                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                                        <p>Код товару: <?= $product['id'] ?></p>
                                        <span>
                                            <span>$<?= $product['price'] ?></span>
                                            <label>Кількість:</label>
                                            <input type="number" value="1" min="1" id="quantity" />
                                            <button type="button" class="btn btn-fefault cart" onclick="addToCart(<?= $product['id'] ?>)">
                                                <i class="fa fa-shopping-cart"></i>
                                                В кошик
                                            </button>
                                        </span>
                                        <p><b>Наявність:</b> На складі</p>
                                        <p><b>Стан:</b> <?= $product['is_new'] ? 'Новий' : 'Б/У' ?></p>
                                        <p><b>Категорія:</b> 
                                            <?php foreach($categories as $cat): ?>
                                                <?php if($cat['id'] == $product['category_id']): ?>
                                                    <?= $cat['name'] ?>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </p>
                                    </div><!--/product-information-->
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-sm-12">
                                    <h5>Опис товару</h5>
                                    <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                                </div>
                            </div>
                        </div><!--/product-details-->
ч
                    </div>
                </div>
            </div>
        </section>

        <script>
            function addToCart(productId) {
                var quantity = document.getElementById('quantity').value;
                
  
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/cart/add', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Товар додано в кошик!');
                    }
                };
                xhr.send('product_id=' + productId + '&quantity=' + quantity);
            }
        </script>
          
<?php include(ROOT . "/views/layouts/footer.php") ?>