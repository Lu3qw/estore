<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Головна</title>
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
    <link href="/template/css/prettyPhoto.css" rel="stylesheet">
    <link href="/template/css/price-range.css" rel="stylesheet">
    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/main.css" rel="stylesheet">
    <link href="/template/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    <link rel="shortcut icon" href="/template/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/template/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/template/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/template/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/template/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +38 012345678</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> herasymovych.ostap@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="/">
                                <img src="/template/images/home/logo.png" alt="" style="max-width:180px; height:auto;" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
    <li>
        <a href="/cart"><i class="fa fa-shopping-cart"></i> Кошик 
            <?php 
            $cartQuantity = Cart::getTotalQuantity();
            if ($cartQuantity > 0): ?>
                <span class="badge"><?= $cartQuantity ?></span>
            <?php endif; ?>
        </a>
    </li>
    <?php 
    $showAdminPanel = false;
    if (isset($_SESSION['user'])) {
        $user = User::getById($_SESSION['user']);
        if ($user && isset($user['role']) && $user['role'] === 'admin') {
            $showAdminPanel = true;
        }
    }
    ?>
    <?php if ($showAdminPanel): ?>
        <li><a href="/admin"><i class="fa fa-cogs"></i> Адмін-панель</a></li>
    <?php endif; ?>
    <?php if (isset($_SESSION['user'])): ?>
        <li><a href="/user/profile"><i class="fa fa-user"></i> Обліковий запис</a></li>
        <li><a href="/user/logout"><i class="fa fa-sign-out"></i> Вийти</a></li>
    <?php else: ?>
        <li><a href="/user/login"><i class="fa fa-lock"></i> Вхід</a></li>
    <?php endif; ?>
</ul>
                        </div>
                    </div>
                </div>
            </div>  
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="/">Головна</a></li>
                                <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="/catalog">Каталог товарів</a></li>
                                        <li><a href="/cart">Кошик</a></li>
                                    </ul>
                                </li>
                                <li><a href="/about">О магазині</a></li>
                                <li><a href="/contact">Контакти</a></li>
                            </ul>
                        </div>
                        <div class="search_box pull-right">
                            <form method="GET" action="/search" class="search-form">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Пошук товарів..." 
                                           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" id="searchInput">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- Search suggestions dropdown -->
                            <div id="searchSuggestions" class="search-suggestions" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->

    </header><!--/header-->

    <style>
.search-form {
    position: relative;
    width: 300px;
    top: -6px;
}

.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-top: none;
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.search-suggestion {
    padding: 10px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.search-suggestion:hover {
    background-color: #f5f5f5;
}

.search-suggestion.selected {
    background-color: #e8f4f8;
}

.search-suggestion img {
    width: 40px;
    height: 40px;
    object-fit: cover;
    margin-right: 10px;
}

.search-suggestion-info {
    flex: 1;
}

.search-suggestion-name {
    font-weight: bold;
    color: #333;
}

.search-suggestion-price {
    color: #666;
    font-size: 0.9em;
}

.search-suggestion mark {
    background-color: #ffeb3b;
    padding: 0 2px;
    border-radius: 2px;
}
</style>

<!-- Include search widget script -->
<script src="/template/js/search.js"></script>