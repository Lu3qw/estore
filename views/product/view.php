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

                                    
                                    <div class="favourite">
                                        <?php 
                                        $userId = $_SESSION['user'] ?? null;
                                        $isFavorite = $userId ? Favorite::isFavorite($userId, $product['id']) : false;
                                        ?>
                                        
                                        <?php if($userId): ?>
                                            <?php if($isFavorite): ?>
                                                <form method="post" action="/favorite/remove/<?= $product['id'] ?>" style="display:inline;">
                                                    <button type="submit" class="btn btn-danger add-to-cart">
                                                        <i class="fa fa-heart"></i>
                                                        Видалити з обраного
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="post" action="/favorite/add/<?= $product['id'] ?>" style="display:inline;">
                                                    <button type="submit" class="btn btn-default add-to-cart">
                                                        <i class="fa fa-heart-o"></i>
                                                        В обране
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        
                                        <?php if($product['is_new']): ?>
                                            <img src="/template/images/product-details/new.jpg" class="newarrival" alt="new" />
                                        <?php endif ?>
                                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                                        <p>Код товару: <?= $product['id'] ?></p>
                                        <span>
                                            <span>$<?= $product['price'] ?></span>
                                            <label>Кількість:</label>
                                            <input type="number" value="1" min="1" id="quantity" />
                                            <button type="button" class="btn btn-fefault cart" style="background-color:rgb(126, 25, 221);" onclick="addToCart(<?= $product['id'] ?>)">
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
                                        <h5>Опис товару</h5>
                                        <div style="white-space: pre-line;">
                                            <?= htmlspecialchars($product['description']) ?>
                                        </div>
                                    </div>

                                    <!-- Форма для відгуків тільки для авторизованих користувачів -->
                                    <?php if($userId): ?>
                                        <hr>
                                        <h5>Залишити відгук</h5>
                                        <form method="post" action="/review/add/<?= $product['id'] ?>">
                                            <div class="form-group">
                                                <label>Оцінка:</label>
                                                <div class="rating" style="font-size:2em; color:#FFD700;">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" style="display:none;" required>
                                                        <label for="star<?= $i ?>" style="cursor:pointer;">&#9733;</label>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="text" class="form-control" rows="3" required placeholder="Ваш відгук..."></textarea>
                                            </div>
                                            <button type="submit" name="submit_review" class="btn btn-primary" style="background-color:#a259e6;">Надіслати</button>
                                        </form>
                                    <?php else: ?>
                                        <hr>
                                        <p><a href="/user/login">Увійдіть</a>, щоб залишити відгук.</p>
                                    <?php endif; ?>
                                    
                                    <script>
                                    // Зірковий рейтинг: підсвічування при наведенні та виборі
                                    const ratingLabels = document.querySelectorAll('.rating label');
                                    const ratingInputs = document.querySelectorAll('.rating input');
                                    ratingLabels.forEach((label, idx) => {
                                        label.addEventListener('mouseenter', function() {
                                            for (let i = 0; i <= idx; i++) ratingLabels[i].style.color = '#FFD700';
                                            for (let i = idx + 1; i < ratingLabels.length; i++) ratingLabels[i].style.color = '#ccc';
                                        });
                                        label.addEventListener('mouseleave', function() {
                                            let checkedIdx = -1;
                                            ratingInputs.forEach((input, i) => { if (input.checked) checkedIdx = i; });
                                            for (let i = 0; i <= (checkedIdx >= 0 ? checkedIdx : -1); i++) ratingLabels[i].style.color = '#FFD700';
                                            for (let i = (checkedIdx >= 0 ? checkedIdx + 1 : 0); i < ratingLabels.length; i++) ratingLabels[i].style.color = '#ccc';
                                        });
                                        label.addEventListener('click', function() {
                                            for (let i = 0; i <= idx; i++) ratingLabels[i].style.color = '#FFD700';
                                            for (let i = idx + 1; i < ratingLabels.length; i++) ratingLabels[i].style.color = '#ccc';
                                        });
                                    });
                                    </script>

                                    <!-- Відгуки -->
                                    <div class="reviews" style="margin-top:40px;">
                                        <h4>Відгуки</h4>
                                        <?php if (!empty($reviews) && is_array($reviews)): ?>
                                            <?php foreach ($reviews as $review): ?>
                                                <div class="panel panel-default" style="margin-bottom:10px;">
                                                    <div class="panel-heading">
                                                        <strong><?= htmlspecialchars(isset($review['user_name']) ? $review['user_name'] : 'Гість') ?></strong>
                                                        <span class="text-muted" style="font-size:0.9em;float:right;">
                                                            <?= !empty($review['date']) ? date('d.m.Y H:i', strtotime($review['date'])) : '' ?>
                                                        </span>
                                                        <?php if (!empty($review['rating'])): ?>
                                                            <div style="margin-top:5px;">
                                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                                    <span style="color:<?= $i <= $review['rating'] ? '#FFD700' : '#ccc' ?>;">&#9733;</span>
                                                                <?php endfor; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="panel-body">
                                                        <?= nl2br(htmlspecialchars($review['text'])) ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>Ще немає відгуків. Будьте першим!</p>
                                        <?php endif; ?>
                                    </div>

                                    </div><!--/product-information-->
                                </div>
                            </div>

                            
                        </div><!--/product-details-->
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