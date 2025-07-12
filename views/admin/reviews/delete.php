<?php
require_once(ROOT . '/views/layouts/header.php');
$review = isset($review) ? $review : null;
if (!$review && isset($id)) {
    $review = Review::getById($id);
}
?>
<div class="container" style="margin-top: 40px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-danger">
                <div class="panel-heading" style="background: #e74c3c; color: #fff;">
                    <h2 class="panel-title" style="margin: 0;">Видалити відгук</h2>
                </div>
                <div class="panel-body" style="padding: 30px;">
                    <?php if ($review): ?>
                        <p>Ви дійсно бажаєте видалити цей відгук?</p>
                        <div class="well">
                            <strong>Текст:</strong> <?= htmlspecialchars($review['text']) ?><br>
                            <strong>Оцінка:</strong> <?= $review['rating'] ?><br>
                            <strong>Дата:</strong> <?= $review['date'] ?>
                        </div>
                        <form method="post">
                            <button type="submit" class="btn btn-danger">Видалити</button>
                            <a href="/admin/reviews/index" class="btn btn-default">Скасувати</a>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">Відгук не знайдено.</div>
                        <a href="/admin/reviews/index" class="btn btn-default">Назад</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once(ROOT . '/views/layouts/footer.php');
?>
