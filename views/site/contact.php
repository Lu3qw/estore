<?php include(ROOT . "/views/layouts/header.php") ?>

<section id="contact-page" style="padding:40px 0; background:#f9f9f9; min-height:60vh;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="contact-form" style="background:#fff; padding:30px 40px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.05);">
                    <h2 class="title text-center" style="margin-bottom:30px; color:#a259e6; font-weight:700;">Зв'яжіться з нами</h2>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Ваше ім'я" style="border-radius:5px; border:1px solid #eee;">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Email" style="border-radius:5px; border:1px solid #eee;">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" class="form-control" required="required" rows="6" placeholder="Ваше повідомлення" style="border-radius:5px; border:1px solid #eee;"></textarea>
                        </div>
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="btn btn-success" style="background:#a259e6; border:0; padding:10px 40px; font-size:16px; border-radius:5px;">Відправити</button>
                        </div>
                    </form>
                </div>
                <div class="company-info" style="margin-top:40px; text-align:center; color:#888;">
                    <h3 style="color:#a259e6; font-weight:600;">O-Store</h3>
                    <p>м. Київ, вул. Прикладна, 1</p>
                    <p>Телефон: +38 (099) 123-45-67</p>
                    <p>Email: info@o-store.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . "/views/layouts/footer.php") ?>
