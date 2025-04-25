<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $host = $_ENV['DB_HOST']; 
        $dbname = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage());
        }

        $this->createSlidersTableIfNeeded();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance->pdo;
    }

    private function __clone() {}

    public function __wakeup() {}


    private function createSlidersTableIfNeeded()
    {
        $query = "SHOW TABLES LIKE 'sliders'";
        $stmt = $this->pdo->query($query);

        if ($stmt->rowCount() == 0) {
            echo "Table 'sliders' does not exist. Creating it now...\n";

            $createTableQuery = "
                CREATE TABLE sliders (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    title VARCHAR(255) NOT NULL,
                    description TEXT NOT NULL,
                    image VARCHAR(255) NOT NULL,
                    status ENUM('active', 'inactive') DEFAULT 'active'
                );
            ";

            $this->pdo->exec($createTableQuery);
            echo "Table 'sliders' created successfully.\n";
        } else {
            echo "Table 'sliders' already exists.\n";
        }
    }
}