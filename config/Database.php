<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;

    // Use default XAMPP credentials
    private $host = "localhost";
    private $db_name = "startupinvest";
    private $username = "root";
    private $password = "";

    private function __construct() {
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
