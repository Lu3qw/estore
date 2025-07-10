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
                                                <a href="/category/<?= $categoryItem['id'] ?>"><?= $categoryItem['name'] ?></a>
                                            </h4>
                                        </div>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Останні товари</h2>

                            <?php foreach($latestProducts as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="/product/<?= $product['id'] ?>">
                                                <img src="/template/images/home/product1.jpg" alt="" />
                                            </a>
                                            <h2>$<?= $product['price'] ?></h2>
                                            <p>
                                                <a href="/product/<?= $product['id'] ?>">
                                                    <?= $product['name'] ?>
                                                </a>
                                            </p>
  
                                            <button type="button" class="btn btn-default add-to-cart" onclick="addToCart(<?= $product['id'] ?>)">
                                                <i class="fa fa-shopping-cart"></i>
                                                В кошик
                                            </button>
                                        </div>
                                        <?php if($product['is_new']): ?>
                                            <img src="/template/images/home/new.png" alt="new" class='new'>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                            
                        </div><!--features_items-->

    
                    </div>
                </div>
            </div>
        </section>

        <script>
            function addToCart(productId) {
                
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/cart/add', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert('Товар додано в кошик!');
                    }
                };
                xhr.send('product_id=' + productId + '&quantity=' + 1);
            }
        </script>

<?php include(ROOT . "/views/layouts/footer.php") ?>