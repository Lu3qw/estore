<?php

// FRONT CONTROLLER

// 1. Загальні налаштування

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Підключення файлів системи

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

// 3. Встановлення підключення до БД

// 4. Виклик Router
$router = new Router();
$router->run();


