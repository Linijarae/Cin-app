<?php

class Database {
    private static $instance = null;
    private $connection;

    private $host;
    private $db_name;
    private $username;
    private $password;

    private function loadEnv() {
        $envFile = __DIR__ . '/../../.env';
        if (!file_exists($envFile)) {
            throw new Exception(".env file not found at " . $envFile);
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '#') === 0) continue;
            if (strpos($line, '=') === false) continue;

            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            switch ($key) {
                case 'DB_HOST':
                    $this->host = $value;
                    break;
                case 'DB_NAME':
                    $this->db_name = $value;
                    break;
                case 'DB_USER':
                    $this->username = $value;
                    break;
                case 'DB_PASSWORD':
                    $this->password = $value;
                    break;
            }
        }
    }

    private function __construct() {
        $this->loadEnv();
        
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}