<?php
namespace App\Models;

use Config\Database;
use PDO;

class Review {
    private $conn;
    private $table_name = "reviews";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (user_id, project_id, note, commentaire) 
                  VALUES (:user_id, :project_id, :note, :commentaire)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $data['user_id']);
        $stmt->bindParam(":project_id", $data['project_id']);
        $stmt->bindParam(":note", $data['note']);
        $stmt->bindParam(":commentaire", $data['commentaire']);

        return $stmt->execute();
    }

    public function getReviewsByProject($project_id) {
        $query = "SELECT r.*, u.pseudo, u.nom, u.prenom 
                  FROM " . $this->table_name . " r
                  JOIN users u ON r.user_id = u.id
                  WHERE r.project_id = :project_id
                  ORDER BY r.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $project_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAverageRating($project_id) {
        $query = "SELECT AVG(note) as average FROM " . $this->table_name . " WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $project_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average'] ? round($result['average'], 1) : 0;
    }
}
