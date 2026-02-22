<?php
require_once __DIR__ . '/../classes/database.php';

class ReservationModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Enregistrer une réservation
    public function create($userId, $movieId, $seats, $screeningDate, $totalPrice) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO reservations (user_id, movie_id, number_of_seats, screening_date, total_price) 
                VALUES (:user_id, :movie_id, :seats, :screening_date, :total_price)
            ");
            
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':movie_id', $movieId, PDO::PARAM_INT);
            $stmt->bindValue(':seats', $seats, PDO::PARAM_INT);
            $stmt->bindValue(':screening_date', $screeningDate, PDO::PARAM_STR);
            $stmt->bindValue(':total_price', $totalPrice, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Récupérer les réservations d'un utilisateur (avec infos du film)
    public function getByUserId($userId) {
        $sql = "SELECT r.*, m.name as movie_name, m.image_url 
                FROM reservations r 
                JOIN movies m ON r.movie_id = m.id 
                WHERE r.user_id = :user_id 
                ORDER BY r.screening_date DESC";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($reservationId, $userId) {
        $stmt = $this->db->prepare("DELETE FROM reservations WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':id', $reservationId, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}