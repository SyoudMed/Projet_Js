<?php
namespace App\Models;

use Config\Database;
use PDO;

class Investment {
    private $conn;
    private $table_name = "investments";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (investor_id, project_id, nb_actions, montant_total) 
                  VALUES (:investor_id, :project_id, :nb_actions, :montant_total)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":investor_id", $data['investor_id']);
        $stmt->bindParam(":project_id", $data['project_id']);
        $stmt->bindParam(":nb_actions", $data['nb_actions']);
        $stmt->bindParam(":montant_total", $data['montant_total']);

        return $stmt->execute();
    }

    public function getInvestmentsByInvestor($investor_id) {
        $query = "SELECT i.*, p.titre, p.statut, p.secteur 
                  FROM " . $this->table_name . " i 
                  JOIN projects p ON i.project_id = p.id 
                  WHERE i.investor_id = :investor_id 
                  ORDER BY i.date_investissement DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":investor_id", $investor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSoldActionsByProject($project_id) {
        $query = "SELECT SUM(nb_actions) as sold FROM " . $this->table_name . " WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $project_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['sold'] ? (int)$result['sold'] : 0;
    }

    public function getInvestmentById($id) {
        $query = "SELECT i.*, p.titre, p.secteur, p.prix_unitaire, 
                  u_inv.nom as investor_nom, u_inv.prenom as investor_prenom, u_inv.email as investor_email,
                  u_sta.nom_entreprise as startup_name
                  FROM " . $this->table_name . " i 
                  JOIN projects p ON i.project_id = p.id 
                  JOIN users u_inv ON i.investor_id = u_inv.id
                  JOIN users u_sta ON p.startuper_id = u_sta.id
                  WHERE i.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInvestorsByProject($project_id) {
        $query = "SELECT i.*, u.nom, u.prenom, u.email, u.pseudo
                  FROM " . $this->table_name . " i 
                  JOIN users u ON i.investor_id = u.id 
                  WHERE i.project_id = :project_id 
                  ORDER BY i.date_investissement DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $project_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTotalRaised() {
        $query = "SELECT SUM(montant_total) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
