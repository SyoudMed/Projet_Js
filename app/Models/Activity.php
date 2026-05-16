<?php
namespace App\Models;

use Config\Database;
use PDO;

class Activity {
    private $conn;
    private $table_name = "activities";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function log($user_id, $action_type, $description) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, action_type, description) VALUES (:user_id, :action_type, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":action_type", $action_type);
        $stmt->bindParam(":description", $description);
        return $stmt->execute();
    }

    public function getRecent($limit = 5) {
        $query = "SELECT a.*, u.pseudo, u.role 
                  FROM " . $this->table_name . " a 
                  LEFT JOIN users u ON a.user_id = u.id 
                  ORDER BY a.created_at DESC 
                  LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
