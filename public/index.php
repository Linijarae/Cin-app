<?php

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

switch ($path) {
    case '/':
        $titre = "indexxxx"; 
        require './src/views/home.php';
        break;
    case '/home':
        $titre = "Bienvenue"; 
        require './src/views/home.php';
        break;

    case '/login':
        $titre = "Log in here";
        require '../src/views/login.php';
        break;

    case '/profile':
        require './src/views/profile.php';
        break;

    default:
        http_response_code(404);
        require './src/views/404.php';
        break;
}