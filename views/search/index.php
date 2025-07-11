<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Фільтри пошуку</h2>
                    
                    <form method="GET" action="/search" id="searchForm">
                        <!-- Search Query -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Пошук</h4>
                            </div>
                            <div class="panel-body">
                                <input type="text" name="q" class="form-control" placeholder="Назва товару..." 
                                       value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Категорія</h4>
                            </div>
                            <div class="panel-body">
                                <select name="category" class="form-control">
                                    <option value="">Всі категорії</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" 
                                                <?= ($_GET['category'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Price Range Filter -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Ціна</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="number" name="min_price" class="form-control" 
                                               placeholder="Від" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="number" name="max_price" class="form-control" 
                                               placeholder="До" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sort Options -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Сортування</h4>
                            </div>
                            <div class="panel-body">
                                <select name="sort" class="form-control">
                                    <option value="name" <?= ($_GET['sort'] ?? 'name') == 'name' ? 'selected' : '' ?>>По назві</option>
                                    <option value="price" <?= ($_GET['sort'] ?? '') == 'price' ? 'selected' : '' ?>>По ціні</option>
                                    <option value="created_at" <?= ($_GET['sort'] ?? '') == 'created_at' ? 'selected' : '' ?>>По даті</option>
                                </select>
                                <br>
                                <select name="order" class="form-control">
                                    <option value="asc" <?= ($_GET['order'] ?? 'asc') == 'asc' ? 'selected' : '' ?>>За зростанням</option>
                                    <option value="desc" <?= ($_GET['order'] ?? '') == 'desc' ? 'selected' : '' ?>>За спаданням</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Пошук</button>
                        <a href="/search" class="btn btn-default btn-block">Скинути</a>
                    </form>
                </div>
            </div>
            
            <div class="col-sm-9">
                <div class="features_items">
                    <h2 class="title text-center">Результати пошуку</h2>
                    
                    <?php if (!empty($_GET['q']) || !empty($_GET['category']) || !empty($_GET['min_price']) || !empty($_GET['max_price'])): ?>
                        <div class="search-info">
                            <p>
                                <?php if (!empty($_GET['q'])): ?>
                                    Пошук по запиту: "<strong><?= htmlspecialchars($_GET['q']) ?></strong>"
                                <?php endif; ?>
                                
                                <?php if (!empty($_GET['category'])): ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <?php if ($cat['id'] == $_GET['category']): ?>
                                            | Категорія: <strong><?= htmlspecialchars($cat['name']) ?></strong>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($_GET['min_price']) || !empty($_GET['max_price'])): ?>
                                    | Ціна: 
                                    <?php if (!empty($_GET['min_price'])): ?>
                                        від <strong>$<?= htmlspecialchars($_GET['min_price']) ?></strong>
                                    <?php endif; ?>
                                    <?php if (!empty($_GET['max_price'])): ?>
                                        до <strong>$<?= htmlspecialchars($_GET['max_price']) ?></strong>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </p>
                            <p>Знайдено результатів: <strong><?= count($products) ?></strong></p>
                        </div>
                        <hr>
                    <?php endif; ?>
                    
                    <?php if (!empty($products)): ?>
                        <div class="row">
                            <?php foreach ($products as $product): ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="<?= $product['image'] ? '/template/images/products/' . $product['image'] : '/template/images/product-details/1.jpg' ?>" 
                                                     alt="<?= htmlspecialchars($product['name']) ?>" 
                                                     style="width: 100%; height: 200px; object-fit: cover;" />
                                                <h2>$<?= $product['price'] ?></h2>
                                                <p><?= htmlspecialchars($product['name']) ?></p>
                                                <a href="/product/<?= $product['id'] ?>" class="btn btn-default add-to-cart">
                                                    <i class="fa fa-eye"></i>Переглянути
                                                </a>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li>
                                                    <a href="/product/<?= $product['id'] ?>">
                                                        <i class="fa fa-plus-square"></i>Детальніше
                                                    </a>
                                                </li>
                                                <li>
                                                    <?php if (isset($_SESSION['user'])): ?>
                                                        <a href="/favorite/add/<?= $product['id'] ?>">
                                                            <i class="fa fa-heart"></i>В обране
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center">
                            <h4><i class="fa fa-search"></i> Нічого не знайдено</h4>
                            <p>Спробуйте змінити критерії пошуку або <a href="/">переглянути всі товари</a></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('searchForm');
    const selects = form.querySelectorAll('select');
    
    selects.forEach(select => {
        select.addEventListener('change', function() {
            form.submit();
        });
    });
});
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>