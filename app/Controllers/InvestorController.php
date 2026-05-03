<?php
namespace App\Controllers;

use App\Models\Project;
use App\Models\Investment;
use App\Models\Favorite;

class InvestorController {
    
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'capital_risque') {
            header("Location: /js_project/public/auth/login");
            exit;
        }
    }

    public function dashboard() {
        $investmentModel = new Investment();
        $favoriteModel = new Favorite();

        $investments = $investmentModel->getInvestmentsByInvestor($_SESSION['user_id']);
        $favorites = $favoriteModel->getFavoritesByInvestor($_SESSION['user_id']);
        
        $totalInvested = 0;
        foreach($investments as $inv) {
            $totalInvested += $inv['montant_total'];
        }

        require __DIR__ . '/../Views/investor/dashboard.php';
    }

    public function catalog() {
        $projectModel = new Project();
        
        $search = $_GET['search'] ?? '';
        $secteur = $_GET['secteur'] ?? '';
        
        $projects = $projectModel->getAllActiveProjects($search, $secteur);
        
        require __DIR__ . '/../Views/investor/catalog.php';
    }

    public function project() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /js_project/public/investor/catalog");
            exit;
        }

        $projectModel = new Project();
        $project = $projectModel->getProjectById($id);

        if (!$project) {
            header("Location: /js_project/public/investor/catalog");
            exit;
        }

        require __DIR__ . '/../Views/investor/project.php';
    }

    public function invest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $project_id = $_POST['project_id'];
            $nb_actions = (int)$_POST['nb_actions'];
            
            $projectModel = new Project();
            $project = $projectModel->getProjectById($project_id);
            
            if ($project && $nb_actions > 0) {
                $montant_total = $nb_actions * $project['prix_unitaire'];
                
                $investmentModel = new Investment();
                $data = [
                    'investor_id' => $_SESSION['user_id'],
                    'project_id' => $project_id,
                    'nb_actions' => $nb_actions,
                    'montant_total' => $montant_total
                ];
                
                if ($investmentModel->create($data)) {
                    header("Location: /js_project/public/investor/dashboard?success=1");
                    exit;
                }
            }
        }
        header("Location: /js_project/public/investor/catalog");
        exit;
    }

    public function toggleFavorite() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $project_id = $_POST['project_id'];
            $favoriteModel = new Favorite();
            $favoriteModel->toggle($_SESSION['user_id'], $project_id);
            
            $referer = $_SERVER['HTTP_REFERER'] ?? '/js_project/public/investor/catalog';
            header("Location: " . $referer);
            exit;
        }
    }
}
