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
        $query = "SELECT p.*, COALESCE(SUM(i.nb_actions), 0) as sold_actions 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN investments i ON p.id = i.project_id 
                  WHERE p.startuper_id = :startuper_id 
                  GROUP BY p.id 
                  ORDER BY p.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":startuper_id", $startuper_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllActiveProjects($search = '', $secteur = '', $statut_filter = '', $sort = 'date_desc', $limit = 10, $offset = 0) {
        $query = "SELECT p.*, u.nom, u.prenom, u.nom_entreprise, 
                  (SELECT COUNT(*) FROM investments i WHERE i.project_id = p.id) as investor_count,
                  ((SELECT COALESCE(SUM(nb_actions), 0) FROM investments i WHERE i.project_id = p.id) / p.nb_actions * 100) as percent_funded
                  FROM " . $this->table_name . " p 
                  JOIN users u ON p.startuper_id = u.id 
                  WHERE 1=1";
        
        if (!empty($statut_filter)) {
            $query .= " AND p.statut = :statut_filter";
        } else {
            $query .= " AND p.statut IN ('actif', 'cloture')";
        }

        if (!empty($secteur)) {
            $query .= " AND p.secteur = :secteur";
        }

        if (!empty($search)) {
            $query .= " AND (p.titre LIKE :search OR p.description LIKE :search)";
        }

        // Sorting Logic
        switch ($sort) {
            case 'price_asc': $query .= " ORDER BY p.prix_unitaire ASC"; break;
            case 'price_desc': $query .= " ORDER BY p.prix_unitaire DESC"; break;
            case 'popularity': $query .= " ORDER BY investor_count DESC"; break;
            case 'funding': $query .= " ORDER BY percent_funded DESC"; break;
            default: $query .= " ORDER BY p.created_at DESC"; break;
        }

        $query .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);

        if (!empty($statut_filter)) $stmt->bindParam(":statut_filter", $statut_filter);
        if (!empty($secteur)) $stmt->bindParam(":secteur", $secteur);
        if (!empty($search)) {
            $search_term = "%$search%";
            $stmt->bindParam(":search", $search_term);
        }
        $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countActiveProjects($search = '', $secteur = '', $statut_filter = '') {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " p WHERE 1=1";
        
        if (!empty($statut_filter)) {
            $query .= " AND p.statut = :statut_filter";
        } else {
            $query .= " AND p.statut IN ('actif', 'cloture')";
        }
        if (!empty($secteur)) $query .= " AND p.secteur = :secteur";
        if (!empty($search)) $query .= " AND (p.titre LIKE :search OR p.description LIKE :search)";

        $stmt = $this->conn->prepare($query);
        if (!empty($statut_filter)) $stmt->bindParam(":statut_filter", $statut_filter);
        if (!empty($secteur)) $stmt->bindParam(":secteur", $secteur);
        if (!empty($search)) {
            $search_term = "%$search%";
            $stmt->bindParam(":search", $search_term);
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
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

    public function getAllProjects($search = '', $secteur = '', $statut_filter = '') {
        $query = "SELECT p.*, u.nom, u.prenom, u.nom_entreprise 
                  FROM " . $this->table_name . " p 
                  JOIN users u ON p.startuper_id = u.id 
                  WHERE 1=1";
        
        if (!empty($statut_filter)) {
            $query .= " AND p.statut = :statut_filter";
        }
        if (!empty($secteur)) {
            $query .= " AND p.secteur = :secteur";
        }
        if (!empty($search)) {
            $query .= " AND (p.titre LIKE :search OR u.nom_entreprise LIKE :search OR p.description LIKE :search)";
        }

        $query .= " ORDER BY p.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        
        if (!empty($statut_filter)) $stmt->bindParam(":statut_filter", $statut_filter);
        if (!empty($secteur)) $stmt->bindParam(":secteur", $secteur);
        if (!empty($search)) {
            $searchTerm = "%{$search}%";
            $stmt->bindParam(":search", $searchTerm);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table_name . " SET statut = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function hasInvestments($project_id) {
        $query = "SELECT COUNT(*) as count FROM investments WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $project_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET titre = :titre, description = :description, secteur = :secteur, 
                      nb_actions = :nb_actions, prix_unitaire = :prix_unitaire, date_limite = :date_limite";
        
        if ($data['business_plan_path']) {
            $query .= ", business_plan_path = :bp";
        }
        if ($data['image_path']) {
            $query .= ", image_path = :img";
        }

        $query .= " WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titre", $data['titre']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":secteur", $data['secteur']);
        $stmt->bindParam(":nb_actions", $data['nb_actions']);
        $stmt->bindParam(":prix_unitaire", $data['prix_unitaire']);
        $stmt->bindParam(":date_limite", $data['date_limite']);
        $stmt->bindParam(":id", $id);

        if ($data['business_plan_path']) {
            $stmt->bindParam(":bp", $data['business_plan_path']);
        }
        if ($data['image_path']) {
            $stmt->bindParam(":img", $data['image_path']);
        }

        return $stmt->execute();
    }
    public function getTopProjectsOfMonth($limit = 5) {
        $query = "SELECT p.*, u.nom_entreprise, 
                  SUM(i.montant_total) as total_raised_month
                  FROM " . $this->table_name . " p 
                  JOIN investments i ON p.id = i.project_id 
                  JOIN users u ON p.startuper_id = u.id
                  WHERE i.date_investissement >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
                  GROUP BY p.id 
                  ORDER BY total_raised_month DESC 
                  LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(":limit", (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
