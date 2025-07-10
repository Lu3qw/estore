<?php 
include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <div class="signup-form"><!--sign up form-->
                    <h2>Реєстрація на сайті</h2>
                    <?php if (isset($result) && $result): ?>
                        <p style="color:green;">Ви успішно зареєстровані! <a href="/user/login">Увійти</a></p>
                    <?php else: ?>
                        <?php if (!empty($errors)): ?>
                            <ul style="color:red;">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <form action="#" method="post">
                            <input type="text" name="name" placeholder="Ім'я" value="<?=$name ?>"/>
                            <input type="email" name="email" placeholder="E-mail" value="<?=$email ?>"/>
                            <input type="password" name="password" placeholder="Пароль" value="<?=$password ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Реєстрація" />
                        </form>
                    <?php endif; ?>
                </div><!--/sign up form-->
            
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>