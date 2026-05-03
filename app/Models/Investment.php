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
        $query = "SELECT i.*, p.titre, p.statut 
                  FROM " . $this->table_name . " i 
                  JOIN projects p ON i.project_id = p.id 
                  WHERE i.investor_id = :investor_id 
                  ORDER BY i.date_investissement DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":investor_id", $investor_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
