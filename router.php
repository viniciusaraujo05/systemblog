<?php

use App\Controller\PostsController;

require_once __DIR__ . '/autoload.php';

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
$uri = $request_uri[0];
$method = $_SERVER['REQUEST_METHOD'];

$routes = [
    '/' => [
        'controller' => 'App\Controller\PostsController',
        'method' => 'index',
    ],
    '/addPost' => [
        'controller' => 'App\Controller\PostsController',
        'method' => 'add',
    ],
    '/updatePost' => [
        'controller' => 'App\Controller\PostsController',
        'method' => 'update',
    ],
    '/deletePost' => [
        'controller' => 'App\Controller\PostsController',
        'method' => 'delete',
    ],
    '/login' => [
        'controller' => 'App\Controller\LoginController',
        'method' => 'index',
    ],
    '/checkUser' => [
        'controller' => 'App\Controller\LoginController',
        'method' => 'checkUser',
    ],
    '/logout' => [
        'controller' => 'App\Controller\LoginController',
        'method' => 'logoutUser',
    ],
];

if (array_key_exists($uri, $routes)) {
    $route = $routes[$uri];
    $controller_name = $route['controller'];
    $method_name = $route['method'];

    $controller = new $controller_name();
    $controller->$method_name();
} else {
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
}