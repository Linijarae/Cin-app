<?php 
require_once 'classes/database.php';

class MoviesModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllMovies() {
        $stmt = $this->db->prepare("SELECT * FROM movies ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovie($id) {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE id = :id");
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}