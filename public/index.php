<?php

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

switch ($path) {
    case '/':
        $titre = "indexxxx"; 
        require 'views/index.php';
        break;
    case '/home':
        $titre = "Bienvenue"; 
        require 'views/home.php';
        break;

    case '/login':
        $titre = "Log in here";
        require 'views/login.php';
        break;

    case '/profile':
        require 'views/profile.php';
        break;

    default:
        http_response_code(404);
        require 'pages/404.php';
        break;
}