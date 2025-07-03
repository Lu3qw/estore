<?php
// This is the entry point of the application

// Autoload classes
require_once '../vendor/autoload.php';

// Include configuration
require_once '../config/routes.php';

// Start the session
session_start();

// Handle the request
$requestUri = $_SERVER['REQUEST_URI'];

// Route the request
if ($requestUri === '/') {
    // Load the main page
    require_once '../views/site/index.php';
} elseif (strpos($requestUri, '/category/') === 0) {
    // Load category page logic here
} elseif (strpos($requestUri, '/product/') === 0) {
    // Load product page logic here
} else {
    // Load the 404 error page
    require_once '../views/site/404.php';
}
?>