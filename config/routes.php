<?php

return [
    // Товари
    'product/([0-9]+)' => 'product/view/$1',
    
    // Каталог
    'catalog' => 'catalog/index',
    'category/([0-9]+)' => 'catalog/category/$1',

    // Відгуки
    'review/add/([0-9]+)' => 'review/add/$1',

    // Улюблені товари
    'favorite/add/([0-9]+)' => 'favorite/add/$1',
    'favorite/remove/([0-9]+)' => 'favorite/remove/$1',
    'user/favorites' => 'favorite/index',
    
    // Кошик
    'cart/add' => 'cart/add',
    'cart/update' => 'cart/update',
    'cart/remove' => 'cart/remove',
    'cart/clear' => 'cart/clear',
    'cart/checkout' => 'cart/checkout',
    'cart/success/([0-9]+)' => 'cart/success/$1',
    'cart' => 'cart/index',

    'search' => 'search/index',
    'search/ajax' => 'search/ajax',
    
    // Користувачі
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/profile' => 'user/profile',
    'user/edit' => 'user/edit',
    'user' => 'user/index',
    
    // Адмін панель
    'admin/products/index' => 'admin/products/index',
    'admin/products/create' => 'admin/products/create',
    'admin/products/update/([0-9]+)' => 'admin/products/update/$1',
    'admin/products/delete/([0-9]+)' => 'admin/products/delete/$1',

    'admin/categories/index' => 'admin/categories/index',
    'admin/categories/create' => 'admin/categories/create',
    'admin/categories/update/([0-9]+)' => 'admin/categories/update/$1',
    'admin/categories/delete/([0-9]+)' => 'admin/categories/delete/$1',

    'admin/orders/index' => 'admin/orders/index',
    'admin/orders/view/([0-9]+)' => 'admin/orders/view/$1',
    'admin/orders/update/([0-9]+)' => 'admin/orders/update/$1',
    'admin/orders/delete/([0-9]+)' => 'admin/orders/delete/$1',

    'admin/users/index' => 'admin/users/index',
    'admin/users/create' => 'admin/users/create',
    'admin/users/update/([0-9]+)' => 'admin/users/update/$1',
    'admin/users/delete/([0-9]+)' => 'admin/users/delete/$1',

    'admin/reviews/index' => 'admin/reviews/index',
    'admin/reviews/view/([0-9]+)' => 'admin/reviews/view/$1',
    'admin/reviews/update/([0-9]+)' => 'admin/reviews/update/$1',
    'admin/reviews/delete/([0-9]+)' => 'admin/reviews/delete/$1',

    'admin' => 'admin/index',
    
    // Головна сторінка
    'about' => 'site/about',
    'contact' => 'site/contact',
    '' => 'site/index',
    
];