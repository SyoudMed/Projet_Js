<?php
namespace App\Controllers;

use App\Models\Project;

class StartuperController {
    
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'startuper') {
            header("Location: " . URLROOT . "/auth/login");
            exit;
        }
    }

    public function dashboard() {
        $projectModel = new Project();
        $projects = $projectModel->getProjectsByStartuper($_SESSION['user_id']);
        
        $totalProjects = count($projects);
        
        require __DIR__ . '/../Views/startuper/dashboard.php';
    }

    public function create() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $projectModel = new Project();
            
            // Handle File Uploads
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $bpPath = null;
            $imgPath = null;

            if (isset($_FILES['business_plan']) && $_FILES['business_plan']['error'] === UPLOAD_ERR_OK) {
                $bpName = time() . '_' . basename($_FILES['business_plan']['name']);
                move_uploaded_file($_FILES['business_plan']['tmp_name'], $uploadDir . $bpName);
                $bpPath = '/uploads/' . $bpName;
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imgName = time() . '_' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imgName);
                $imgPath = '/uploads/' . $imgName;
            }

            $data = [
                'startuper_id' => $_SESSION['user_id'],
                'titre' => $_POST['titre'] ?? '',
                'description' => $_POST['description'] ?? '',
                'secteur' => $_POST['secteur'] ?? '',
                'nb_actions' => $_POST['nb_actions'] ?? 0,
                'prix_unitaire' => $_POST['prix_unitaire'] ?? 0,
                'date_limite' => $_POST['date_limite'] ?? '',
                'business_plan_path' => $bpPath,
                'image_path' => $imgPath
            ];

            if ($projectModel->create($data)) {
                header("Location: " . URLROOT . "/startuper/dashboard");
                exit;
            } else {
                $error = "Erreur lors de la création du projet.";
            }
        }
        require __DIR__ . '/../Views/startuper/create.php';
    }
}
