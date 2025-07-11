<?php
require_once(ROOT . '/views/layouts/header.php');
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #a259e6; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Редагувати категорію</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <form method="post">
                        <div class="form-group">
                            <label>Назва категорії</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category['name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Порядок сортування</label>
                            <input type="number" name="sort_order" class="form-control" value="<?= $category['sort_order'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Статус</label>
                            <select name="status" class="form-control">
                                <option value="1" <?= $category['status'] ? 'selected' : '' ?>>Активна</option>
                                <option value="0" <?= !$category['status'] ? 'selected' : '' ?>>Неактивна</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Зберегти</button>
                        <a href="/admin/categories" class="btn btn-default">Назад</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(ROOT . '/views/layouts/footer.php');
?>
