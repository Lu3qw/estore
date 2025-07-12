<?php
require_once(ROOT . '/views/layouts/header.php');
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Редагувати товар</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Назва товару</label>
                                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Категорія</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Оберіть категорію</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['id'] ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($category['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Код товару</label>
                                    <input type="text" name="code" class="form-control" value="<?= htmlspecialchars($product['code']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ціна</label>
                                    <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Бренд</label>
                                    <input type="text" name="brand" class="form-control" value="<?= htmlspecialchars($product['brand']) ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Зображення (URL)</label>
                                    <input type="url" name="image" class="form-control" value="<?= htmlspecialchars($product['image']) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Опис</label>
                            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Наявність</label>
                                    <select name="availability" class="form-control">
                                        <option value="1" <?= $product['availability'] ? 'selected' : '' ?>>В наявності</option>
                                        <option value="0" <?= !$product['availability'] ? 'selected' : '' ?>>Немає в наявності</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Новий товар</label>
                                    <select name="is_new" class="form-control">
                                        <option value="0" <?= !$product['is_new'] ? 'selected' : '' ?>>Ні</option>
                                        <option value="1" <?= $product['is_new'] ? 'selected' : '' ?>>Так</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Рекомендований</label>
                                    <select name="is_recommended" class="form-control">
                                        <option value="0" <?= !$product['is_recommended'] ? 'selected' : '' ?>>Ні</option>
                                        <option value="1" <?= $product['is_recommended'] ? 'selected' : '' ?>>Так</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Статус</label>
                                    <select name="status" class="form-control">
                                        <option value="1" <?= $product['status'] ? 'selected' : '' ?>>Активний</option>
                                        <option value="0" <?= !$product['status'] ? 'selected' : '' ?>>Неактивний</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Зберегти зміни</button>
                        <a href="/admin/products/index" class="btn btn-default">Назад</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(ROOT . '/views/layouts/footer.php');
?>