<?php

session_start();

// Chargement des fichiers nécessaires
require_once '../src/classes/database.php';
require_once '../src/models/cineModel.php';
// Ajout du modèle et contrôleur de réservation
require_once '../src/models/reservationModel.php'; 
require_once '../src/controllers/authController.php';
require_once '../src/controllers/reservationController.php';
require_once '../src/controllers/profileController.php';

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// ==========================================
// GESTION DES REQUÊTES POST (Formulaires)
// ==========================================
if ($method === 'POST') {
    
    if ($path === '/profile/cancel') {
        $profileController = new ProfileController();
        $resId = $_POST['reservation_id'] ?? null;
        
        $result = $profileController->cancelReservation($resId);
        
        // On stocke le message pour l'afficher après la redirection
        // Note: Idéalement on utilise $_SESSION['flash_message'], mais ici on fait simple
        if ($result['success']) {
            header('Location: /profile?msg=cancelled');
        } else {
            header('Location: /profile?error=1');
        }
        exit;
    } 
    elseif ($path === '/profile/delete') {
        $profileController = new ProfileController();
        $result = $profileController->deleteAccount();
        
        if ($result['success']) {
            header('Location: /register?msg=account_deleted'); // Redirige vers register ou login
        } else {
            header('Location: /profile?error=delete_failed');
        }
        exit;
    }
    elseif ($path === '/login') {
        $authController = new AuthController();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $result = $authController->login($email, $password);
        
        if ($result['success']) {
            header('Location: /home');
            exit;
        } else {
            $error = $result['message']; // Sera affiché dans la vue login
        }
    } 
    // --- REGISTER ---
    elseif ($path === '/register') {
        $authController = new AuthController();
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $result = $authController->register($name, $email, $password, $confirm_password);
        
        if ($result['success']) {
            $success = $result['message'];
            header('refresh:2;url=/login');
        } else {
            $error = $result['message'];
        }
    }
    // --- RESERVATION (NOUVEAU) ---
    elseif ($path === '/reservation') {
        $resController = new ReservationController();
        // On passe tout $_POST à la méthode handleReservation
        $result = $resController->handleReservation($_POST);

        if ($result['success']) {
            // Succès : on redirige vers le profil pour voir la réservation
            // Ou on affiche un message de succès sur la page
            $success = $result['message'];
            // Optionnel : redirection vers le profil après 2s
             header('refresh:2;url=/profile');
        } else {
            $error = $result['message'];
            // On reste sur la page reservation pour afficher l'erreur
            // Note: il faudra recharger les infos du film ci-dessous dans le switch
        }
    }
}

// ==========================================
// GESTION DU LOGOUT
// ==========================================
if ($path === '/logout') {
    $authController = new AuthController();
    $authController->logout();
    header('Location: /login');
    exit;
}

// ==========================================
// ROUTAGE (AFFICHAGE DES VUES)
// ==========================================
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
        $titre = "My Profile";
        $profileController = new ProfileController();
        
        // Récupérer les données
        $data = $profileController->index();
        
        // Extraire les variables pour la vue ($user et $reservations)
        $user = $data['user'];
        $reservations = $data['reservations'];

        // Petit gestionnaire de messages via URL (suite aux redirections POST)
        if (isset($_GET['msg']) && $_GET['msg'] == 'cancelled') {
            $message = "Reservation cancelled successfully.";
            $success = true;
        }
        if (isset($_GET['error'])) {
            $message = "An error occurred.";
            $success = false;
        }

        require '../src/views/profile.php';
        break;

    case '/register':
        $titre = "Register";
        require '../src/views/register.php';
        break;

    case '/reservation':
        $titre = "Reservation";
        
        // Si on a cliqué sur "Réserver" depuis la home, on a un ID dans l'URL (?id=5)
        // On récupère les infos du film pour pré-remplir le formulaire
        $movieId = $_GET['id'] ?? null;
        $movie = null;
        
        if ($movieId) {
            $moviesModel = new MoviesModel();
            $movie = $moviesModel->getMovie($movieId); // Assure-toi que cette méthode existe dans MoviesModel
        }
        
        require '../src/views/reservation.php';
        break;

    case '/settings': // Correction ortho (setings -> settings)
        $titre = "Settings";
        require '../src/views/setings.php'; // Garde le nom du fichier s'il est mal orthographié
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