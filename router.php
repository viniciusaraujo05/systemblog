<?php

use App\Controller\PostsController;

require_once __DIR__ . '/autoload.php';

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
$uri = $request_uri[0];
$method = $_SERVER['REQUEST_METHOD'];

// Define routes
$routes = [
    '/' => [
        'controller' => 'App\Controller\PostsController',
        'method' => 'index',
    ],
    '/addPost' => [
        'controller' => 'App\Controller\PostsController',
        'method' => 'addPost',
    ],
];

// Check if the requested route exists
if (array_key_exists($uri, $routes)) {
    $route = $routes[$uri];
    $controller_name = $route['controller'];
    $method_name = $route['method'];

    $controller = new $controller_name();
    $controller->$method_name();

    // Create controller instance and call method

} else {
    // Show 404 page
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
}