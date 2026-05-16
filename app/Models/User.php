<?php
namespace App\Models;

use Config\Database;
use PDO;

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nom, prenom, cin, email, pseudo, password, role, nom_entreprise, adresse_entreprise, registre_commerce) 
                  VALUES (:nom, :prenom, :cin, :email, :pseudo, :password, :role, :nom_entreprise, :adresse_entreprise, :registre_commerce)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom", $data['nom']);
        $stmt->bindParam(":prenom", $data['prenom']);
        $stmt->bindParam(":cin", $data['cin']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":pseudo", $data['pseudo']);
        
        $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password);
        
        $stmt->bindParam(":role", $data['role']);
        $stmt->bindParam(":nom_entreprise", $data['nom_entreprise']);
        $stmt->bindParam(":adresse_entreprise", $data['adresse_entreprise']);
        $stmt->bindParam(":registre_commerce", $data['registre_commerce']);

        return $stmt->execute();
    }

    public function login($pseudo_or_email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE pseudo = :pseudo OR email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":pseudo", $pseudo_or_email);
        $stmt->bindParam(":email", $pseudo_or_email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $row['password'])) {
                if($row['statut'] === 'bloque') {
                    return 'blocked';
                }
                return $row;
            }
        }
        return false;
    }

    public function checkExists($email, $pseudo) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email OR pseudo = :pseudo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getAllUsers($search = '', $role = '') {
        $query = "SELECT * FROM " . $this->table_name . " WHERE role != 'admin'";
        
        if (!empty($role)) {
            $query .= " AND role = :role";
        }
        if (!empty($search)) {
            $query .= " AND (pseudo LIKE :search OR email LIKE :search OR nom LIKE :search OR prenom LIKE :search OR nom_entreprise LIKE :search)";
        }

        $query .= " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        
        if (!empty($role)) $stmt->bindParam(":role", $role);
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

    public function getAdmin() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE role = 'admin' LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nom = :nom, prenom = :prenom, email = :email, pseudo = :pseudo, 
                      nom_entreprise = :nom_entreprise, adresse_entreprise = :adresse_entreprise 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nom", $data['nom']);
        $stmt->bindParam(":prenom", $data['prenom']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":pseudo", $data['pseudo']);
        $stmt->bindParam(":nom_entreprise", $data['nom_entreprise']);
        $stmt->bindParam(":adresse_entreprise", $data['adresse_entreprise']);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function updatePassword($id, $new_password) {
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
