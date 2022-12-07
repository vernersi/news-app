<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';
session_start();
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
require_once "../app/NewsApiRequest.php";
$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);
$authVariables = [
    \App\viewVariables\AuthViewVariables::class,
    \App\viewVariables\ErrorsViewVariable::class
];
foreach ($authVariables as $variable){
    $variable = new $variable;
    $twig->addGlobal($variable->getName(), $variable->getValue());
}

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', ['App\Controllers\NewsController', 'index']);
    $route->addRoute('GET', '/section', ['App\Controllers\NewsController', 'section']);
    $route->addRoute('GET', '/search', ['App\Controllers\NewsController', 'search']);
    $route->addRoute('GET', '/register', ['App\Controllers\RegisterController', 'showForm']);
    $route->addRoute('POST', '/register', ['App\Controllers\RegisterController', 'store']);
    $route->addRoute('GET', '/login', ['App\Controllers\LoginController', 'showForm']);
    $route->addRoute('POST', '/login', ['App\Controllers\LoginController', 'login']);
    $route->addRoute('GET', '/profile', ['App\Controllers\ProfileController', 'showForm']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;
        $response = (new $controller)->{$method}();
        if ($response instanceof \App\Template) {
            echo $twig->render('head.twig');
            echo $twig->render('navbar.twig');
            echo $twig->render($response->getPath(), $response->getParams());
            echo $twig->render('footer.twig');
            unset($_SESSION['errors']);
        }

        if ($response instanceof \App\Redirect){
            header('Location: '.$response->getUrl());
        }

        break;
}
?>