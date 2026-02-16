<?php

session_start();

require_once '../src/classes/database.php';
require_once '../src/models/cineModel.php';
require_once '../src/controllers/authController.php';

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Gestion des POST requests
if ($method === 'POST') {
    $authController = new AuthController();
    
    if ($path === '/login') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = $authController->login($email, $password);
        
        if ($result['success']) {
            header('Location: /home');
            exit;
        } else {
            $error = $result['message'];
        }
    } elseif ($path === '/register') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $result = $authController->register($name, $email, $password, $confirm_password);
        
        if ($result['success']) {
            $success = $result['message'];
            // Redirection après 2 secondes
            header('refresh:2;url=/login');
        } else {
            $error = $result['message'];
        }
    }
}

// Gestion du logout
if ($path === '/logout') {
    $authController = new AuthController();
    $authController->logout();
    header('Location: /login');
    exit;
}

switch ($path) {
    case '/':
        header('Location: /home');
        exit;
        break;
    case '/index':
        $titre = "Index";
        $moviesModel = new MoviesModel();
        $movies = $moviesModel->getAllMovies();
        require '../src/views/index.php';
        break;
    case '/home':
        $titre = "Bienvenue";
        $moviesModel = new MoviesModel();
        $movies = $moviesModel->getAllMovies();
        require '../src/views/home.php';
        break;

    case '/login':
        $titre = "Log in here";
        require '../src/views/login.php';
        break;

    case '/profile':
        require '../src/views/profile.php';
        break;
    case '/register':
        $titre = "Register";
        require '../src/views/register.php';
        break;
    case '/reservation':
        $titre = "Reservation";
        require '../src/views/reservation.php';
        break;
    case '/setings':
        $titre = "Settings";
        require '../src/views/setings.php';
        break;
    case '/cgu':
        $titre = "CGU";
        require '../src/views/cgu.php';
        break;

    default:
        http_response_code(404);
        require '../src/views/404.php';
        break;
}