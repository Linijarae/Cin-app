<?php

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

switch ($path) {
    case '/':
        header('Location: /home');
        exit;
        break;
    case '/index':
        $titre = "Index";
        require './src/views/index.php';
        break;
    case '/home':
        $titre = "Bienvenue"; 
        require '../src/views/home.php';
        break;

    case '/login':
        $titre = "Log in here";
        require './src/views/login.php';
        break;

    case '/profile':
        require './src/views/profile.php';
        break;
    case '/register':
        $titre = "Register";
        require './src/views/register.php';
        break;
    case '/reservation':
        $titre = "Reservation";
        require './src/views/reservation.php';
        break;
    case '/setings':
        $titre = "Settings";
        require './src/views/setings.php';
        break;
    case '/cgu':
        $titre = "CGU";
        require './src/views/cgu.php';
        break;

    default:
        http_response_code(404);
        require './src/views/404.php';
        break;
}