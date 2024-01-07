<?php
require_once './../Controller/UserController.php';
require_once './../Controller/MainController.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/registrate') {
    $userController = new UserController();
    if ($requestMethod === 'GET') {
        $userController->getRegistrate();
    } elseif ($requestMethod === 'POST') {
        $userController->registrate();
    } else {
        echo  "Method $requestMethod don't support for $requestUri";
    }
} elseif ($requestUri === '/login') {
    $userController = new UserController();
    if ($requestMethod === 'GET') {
        $userController->getLogin();
    } elseif ($requestMethod === 'POST') {
        $userController->login();
    } else {
        echo  "Method $requestMethod don't support for $requestUri";
    }
} elseif ($requestUri === '/main') {
    $mainController = new MainController();
    $userController = new UserController();
    if ($requestMethod === 'GET') {
        $mainController->getProducts();
    } elseif($requestUri === '/login') {
        $userController->logout();
    } else {
        echo  "Method $requestMethod don't support for $requestUri";
    }
} else {
    require_once './../View/not_found.php';
}
