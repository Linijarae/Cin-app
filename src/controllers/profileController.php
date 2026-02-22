<?php
require_once __DIR__ . '/../models/userModel.php';
require_once __DIR__ . '/../models/reservationModel.php';

class ProfileController {
    private $userModel;
    private $reservationModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->reservationModel = new ReservationModel();
    }

    // Affiche le profil
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        
        // Récupérer les infos perso
        $user = $this->userModel->getUserById($userId);
        
        // Récupérer l'historique
        $reservations = $this->reservationModel->getByUserId($userId);

        // On retourne les données pour qu'elles soient accessibles dans la vue
        return [
            'user' => $user,
            'reservations' => $reservations
        ];
    }

    // Annuler une réservation
    public function cancelReservation($reservationId) {
        if (!isset($_SESSION['user_id'])) return ['success' => false, 'message' => 'Auth required'];

        $success = $this->reservationModel->delete($reservationId, $_SESSION['user_id']);

        if ($success) {
            return ['success' => true, 'message' => 'Réservation annulée avec succès.'];
        } else {
            return ['success' => false, 'message' => 'Impossible d\'annuler cette réservation.'];
        }
    }

    // Supprimer le compte
    public function deleteAccount() {
        if (!isset($_SESSION['user_id'])) return;

        $userId = $_SESSION['user_id'];
        $success = $this->userModel->deleteUser($userId);

        if ($success) {
            session_destroy(); // On déconnecte l'utilisateur
            return ['success' => true, 'message' => 'Compte supprimé. Au revoir !'];
        } else {
            return ['success' => false, 'message' => 'Erreur lors de la suppression du compte.'];
        }
    }
}