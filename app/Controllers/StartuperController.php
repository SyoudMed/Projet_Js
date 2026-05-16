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
        $investmentModel = new \App\Models\Investment();
        
        $projects = $projectModel->getProjectsByStartuper($_SESSION['user_id']);
        $totalProjects = count($projects);
        
        $totalRaised = 0;
        $uniqueInvestors = [];
        
        foreach($projects as $p) {
            $sold = $investmentModel->getSoldActionsByProject($p['id']);
            $totalRaised += ($sold * $p['prix_unitaire']);
            
            $investors = $investmentModel->getInvestorsByProject($p['id']);
            foreach($investors as $inv) {
                $uniqueInvestors[$inv['investor_id']] = true;
            }
        }
        
        $totalInvestors = count($uniqueInvestors);
        
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

    public function investors() {
        $project_id = $_GET['project_id'] ?? null;
        if (!$project_id) {
            header("Location: " . URLROOT . "/startuper/dashboard");
            exit;
        }

        $projectModel = new Project();
        $investmentModel = new \App\Models\Investment();

        $project = $projectModel->getProjectById($project_id);
        
        // Security check
        if (!$project || $project['startuper_id'] != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/startuper/dashboard");
            exit;
        }

        $investors = $investmentModel->getInvestorsByProject($project_id);
        $totalSold = $investmentModel->getSoldActionsByProject($project_id);
        $totalRaised = $totalSold * $project['prix_unitaire'];

        require __DIR__ . '/../Views/startuper/investors.php';
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . URLROOT . "/startuper/dashboard");
            exit;
        }

        $projectModel = new Project();
        $investmentModel = new \App\Models\Investment();
        $reviewModel = new \App\Models\Review();

        $project = $projectModel->getProjectById($id);
        if (!$project || $project['startuper_id'] != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/startuper/dashboard");
            exit;
        }

        $investors = $investmentModel->getInvestorsByProject($id);
        $reviews = $reviewModel->getReviewsByProject($id);
        $avgRating = $reviewModel->getAverageRating($id);
        $totalSold = $investmentModel->getSoldActionsByProject($id);

        require __DIR__ . '/../Views/startuper/show.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . URLROOT . "/startuper/dashboard");
            exit;
        }

        $projectModel = new Project();
        $project = $projectModel->getProjectById($id);

        if (!$project || $project['startuper_id'] != $_SESSION['user_id'] || $projectModel->hasInvestments($id)) {
            header("Location: " . URLROOT . "/startuper/dashboard?error=restricted");
            exit;
        }

        require __DIR__ . '/../Views/startuper/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $projectModel = new Project();
            $project = $projectModel->getProjectById($id);

            if (!$project || $project['startuper_id'] != $_SESSION['user_id'] || $projectModel->hasInvestments($id)) {
                header("Location: " . URLROOT . "/startuper/dashboard?error=restricted");
                exit;
            }

            $uploadDir = __DIR__ . '/../../public/uploads/';
            $bpPath = $project['business_plan_path'];
            $imgPath = $project['image_path'];

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
                'titre' => $_POST['titre'],
                'description' => $_POST['description'],
                'secteur' => $_POST['secteur'],
                'nb_actions' => $_POST['nb_actions'],
                'prix_unitaire' => $_POST['prix_unitaire'],
                'date_limite' => $_POST['date_limite'],
                'business_plan_path' => $bpPath,
                'image_path' => $imgPath
            ];

            if ($projectModel->update($id, $data)) {
                header("Location: " . URLROOT . "/startuper/dashboard?success=updated");
            } else {
                header("Location: " . URLROOT . "/startuper/edit?id=$id&error=1");
            }
            exit;
        }
    }

    public function abandon() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $projectModel = new Project();
            $project = $projectModel->getProjectById($id);

            if ($project && $project['startuper_id'] == $_SESSION['user_id']) {
                $projectModel->updateStatus($id, 'abandonne');
                header("Location: " . URLROOT . "/startuper/dashboard?success=abandoned");
                exit;
            }
        }
        header("Location: " . URLROOT . "/startuper/dashboard");
    }
}
