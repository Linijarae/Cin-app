<?php 
require_once 'classes/database.php';

class MoviesModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->connection;
    }

    public function getAllMovies() {
        $stmt = $this->db->prepare("SELECT * FROM movies ORDER BY ic DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovie(){
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE id = :id");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}