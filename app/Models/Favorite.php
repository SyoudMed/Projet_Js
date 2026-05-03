<?php
namespace App\Models;

use Config\Database;
use PDO;

class Favorite {
    private $conn;
    private $table_name = "favorites";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function toggle($investor_id, $project_id) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE investor_id = :investor_id AND project_id = :project_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":investor_id", $investor_id);
        $stmt->bindParam(":project_id", $project_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $query = "DELETE FROM " . $this->table_name . " WHERE investor_id = :investor_id AND project_id = :project_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":investor_id", $investor_id);
            $stmt->bindParam(":project_id", $project_id);
            return $stmt->execute();
        } else {
            $query = "INSERT INTO " . $this->table_name . " (investor_id, project_id) VALUES (:investor_id, :project_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":investor_id", $investor_id);
            $stmt->bindParam(":project_id", $project_id);
            return $stmt->execute();
        }
    }

    public function getFavoritesByInvestor($investor_id) {
        $query = "SELECT p.* 
                  FROM " . $this->table_name . " f 
                  JOIN projects p ON f.project_id = p.id 
                  WHERE f.investor_id = :investor_id 
                  ORDER BY f.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":investor_id", $investor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
