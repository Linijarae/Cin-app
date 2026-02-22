<?php
require_once __DIR__ . '/../models/reservationModel.php';

class ReservationController {
    private $model;

    public function __construct() {
        $this->model = new ReservationModel();
    }

    public function handleReservation($data) {
        // 1. Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            return ['success' => false, 'message' => 'Veuillez vous connecter pour réserver.'];
        }

        $userId = $_SESSION['user_id'];
        $movieId = $data['movie_id'] ?? null;
        $seats = $data['seats'] ?? null;
        $date = $data['date'] ?? null;
        $time = $data['time'] ?? '20:00'; // Heure par défaut si non gérée

        // 2. Validation basique
        if (!$movieId || !$seats || !$date) {
            return ['success' => false, 'message' => 'Tous les champs sont requis.'];
        }

        if ($seats < 1 || $seats > 10) {
            return ['success' => false, 'message' => 'Nombre de places invalide (1-10).'];
        }

        // 3. Calcul du prix (Exemple : 10€ la place)
        $pricePerTicket = 10.00;
        $totalPrice = $seats * $pricePerTicket;

        // Concaténation Date + Heure pour le format SQL DATETIME
        $screeningDate = $date . ' ' . $time . ':00';

        // 4. Enregistrement
        $success = $this->model->create($userId, $movieId, $seats, $screeningDate, $totalPrice);

        if ($success) {
            return ['success' => true, 'message' => 'Réservation confirmée !'];
        } else {
            return ['success' => false, 'message' => 'Erreur lors de la réservation.'];
        }
    }
    
    // Pour afficher l'historique dans le profil
    public function getUserHistory() {
        if (!isset($_SESSION['user_id'])) return [];
        return $this->model->getByUserId($_SESSION['user_id']);
    }
}