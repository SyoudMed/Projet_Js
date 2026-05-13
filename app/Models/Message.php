<?php
namespace App\Models;

use Config\Database;
use PDO;

class Message {
    private $conn;
    private $table_name = "messages";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (sender_id, receiver_id, project_id, contenu) 
                  VALUES (:sender_id, :receiver_id, :project_id, :contenu)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":sender_id", $data['sender_id']);
        $stmt->bindParam(":receiver_id", $data['receiver_id']);
        
        if ($data['project_id'] === null || $data['project_id'] === 'null' || $data['project_id'] === '') {
            $stmt->bindValue(":project_id", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(":project_id", $data['project_id']);
        }
        
        $stmt->bindParam(":contenu", $data['contenu']);

        return $stmt->execute();
    }

    public function getConversationsByUser($user_id) {
        // Group by project and other user to list conversations
        $query = "SELECT m.*, p.titre as project_title, 
                  u_sender.pseudo as sender_name, u_receiver.pseudo as receiver_name
                  FROM " . $this->table_name . " m
                  LEFT JOIN projects p ON m.project_id = p.id
                  JOIN users u_sender ON m.sender_id = u_sender.id
                  JOIN users u_receiver ON m.receiver_id = u_receiver.id
                  WHERE m.sender_id = :user_id OR m.receiver_id = :user_id
                  ORDER BY m.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessagesByProject($project_id, $user1_id, $user2_id) {
        $project_clause = ($project_id === 'null' || $project_id === null) ? "m.project_id IS NULL" : "m.project_id = :project_id";
        
        $query = "SELECT m.*, u.pseudo as sender_name
                  FROM " . $this->table_name . " m
                  JOIN users u ON m.sender_id = u.id
                  WHERE $project_clause 
                  AND ((m.sender_id = :u1 AND m.receiver_id = :u2) 
                   OR (m.sender_id = :u2 AND m.receiver_id = :u1))
                  ORDER BY m.created_at ASC";
        
        $stmt = $this->conn->prepare($query);
        if ($project_id !== 'null' && $project_id !== null) {
            $stmt->bindParam(":project_id", $project_id);
        }
        $stmt->bindParam(":u1", $user1_id);
        $stmt->bindParam(":u2", $user2_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
