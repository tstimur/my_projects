<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/registrate') {
    if ($requestMethod === 'GET') {
        require_once './html/registrate.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handler/registrate.php';
    } else {
        echo  "Method $requestMethod don't support for $requestUri";
    }
} elseif ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        require_once './html/login.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handler/login.php';
    } else {
        echo  "Method $requestMethod don't support for $requestUri";
    }
} elseif ($requestUri === '/main') {
    if ($requestMethod === 'GET') {
        require_once './handler/main.php';
    }
//    elseif ($requestMethod === 'POST') {
//        require_once './handler/main.php';
//    }
    else {
        echo  "Method $requestMethod don't support for $requestUri";
    }
} else {
    require_once './html/not_found.php';
}

