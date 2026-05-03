<?php
namespace App\Models;

use Config\Database;
use PDO;

class Project {
    private $conn;
    private $table_name = "projects";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (startuper_id, titre, description, secteur, nb_actions, prix_unitaire, date_limite, business_plan_path, image_path) 
                  VALUES (:startuper_id, :titre, :description, :secteur, :nb_actions, :prix_unitaire, :date_limite, :business_plan_path, :image_path)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":startuper_id", $data['startuper_id']);
        $stmt->bindParam(":titre", $data['titre']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":secteur", $data['secteur']);
        $stmt->bindParam(":nb_actions", $data['nb_actions']);
        $stmt->bindParam(":prix_unitaire", $data['prix_unitaire']);
        $stmt->bindParam(":date_limite", $data['date_limite']);
        $stmt->bindParam(":business_plan_path", $data['business_plan_path']);
        $stmt->bindParam(":image_path", $data['image_path']);

        return $stmt->execute();
    }

    public function getProjectsByStartuper($startuper_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE startuper_id = :startuper_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":startuper_id", $startuper_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllActiveProjects($search = '', $secteur = '') {
        $query = "SELECT p.*, u.nom, u.prenom, u.nom_entreprise 
                  FROM " . $this->table_name . " p 
                  JOIN users u ON p.startuper_id = u.id 
                  WHERE p.statut IN ('en_attente', 'actif')"; // Temporarily allowing en_attente for testing
        
        if (!empty($search)) {
            $query .= " AND (p.titre LIKE :search OR p.description LIKE :search)";
        }
        if (!empty($secteur)) {
            $query .= " AND p.secteur = :secteur";
        }
        
        $query .= " ORDER BY p.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        
        if (!empty($search)) {
            $searchTerm = "%{$search}%";
            $stmt->bindParam(":search", $searchTerm);
        }
        if (!empty($secteur)) {
            $stmt->bindParam(":secteur", $secteur);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectById($id) {
        $query = "SELECT p.*, u.nom, u.prenom, u.nom_entreprise 
                  FROM " . $this->table_name . " p 
                  JOIN users u ON p.startuper_id = u.id 
                  WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
