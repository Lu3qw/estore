<?php

return [
    // Товари
    'product/([0-9]+)' => 'product/view/$1',
    
    // Каталог
    'catalog' => 'catalog/index',
    'category/([0-9]+)' => 'catalog/category/$1',
    
    // Кошик
    'cart/add' => 'cart/add',
    'cart/update' => 'cart/update',
    'cart/remove' => 'cart/remove',
    'cart/clear' => 'cart/clear',
    'cart/checkout' => 'cart/checkout',
    'cart/success/([0-9]+)' => 'cart/success/$1',
    'cart' => 'cart/index',
    
    // Користувачі
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/profile' => 'user/profile',
    'user' => 'user/index',
    
    // Адмін панель
    'admin/login' => 'admin/login',
    'admin/products' => 'admin/products',
    'admin/categories' => 'admin/categories',
    'admin/orders' => 'admin/orders',
    'admin' => 'admin/index',
    
    // Головна сторінка
    'about' => 'site/about',
    'contact' => 'site/contact',
    '' => 'site/index',
    
];