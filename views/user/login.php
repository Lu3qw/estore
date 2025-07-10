<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <div class="login-form"><!--login form-->
                    <h2>Вхід на сайт</h2>
                    <?php if (!empty($errors)): ?>
                        <ul style="color:red;">
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <form action="#" method="post">
                        <input type="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($email ?? '') ?>"/>
                        <input type="password" name="password" placeholder="Пароль" value="<?= htmlspecialchars($password ?? '') ?>"/>
                        <input type="submit" name="submit" class="btn btn-default" value="Увійти" />
                    </form>
                    <br>
                    <p>Ще не маєте акаунту? <a href="/user/register">Реєстрація</a></p>
                </div><!--/login form-->
            
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php';