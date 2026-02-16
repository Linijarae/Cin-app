<?php
/**
 * Contrôleur d'authentification
 * Gère les opérations de login et register
 */

require_once __DIR__ . '/../classes/database.php';

class AuthController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function register($name, $email, $password, $confirm_password) {
        // Validation basique
        if (empty($name) || empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'All fields are required'];
        }

        if ($password !== $confirm_password) {
            return ['success' => false, 'message' => 'Passwords do not match'];
        }

        if (strlen($password) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters'];
        }

        // Vérifier si l'email existe déjà
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => 'Email already registered'];
        }

        // Créer le nouvel utilisateur
        try {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("
                INSERT INTO users (login, email, password) 
                VALUES (:login, :email, :password)
            ");
            $stmt->bindValue(':login', $name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
            $stmt->execute();

            return ['success' => true, 'message' => 'Registration successful. Please log in.'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Registration error: ' . $e->getMessage()];
        }
    }

    /**
     * Connecter un utilisateur
     */
    public function login($email, $password) {
        if (empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Email and password are required'];
        }

        try {
            $stmt = $this->db->prepare("SELECT id, login, password FROM users WHERE email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$user || !password_verify($password, $user['password'])) {
                return ['success' => false, 'message' => 'Invalid email or password'];
            }

            // Établir la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            
            return ['success' => true, 'message' => 'Login successful'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Login error: ' . $e->getMessage()];
        }
    }

    /**
     * Déconnecter un utilisateur
     */
    public function logout() {
        session_destroy();
        return true;
    }
}
?>