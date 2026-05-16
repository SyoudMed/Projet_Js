<?php
namespace App\Controllers;

use App\Models\Project;
use App\Models\Investment;
use App\Models\Favorite;
use App\Models\Review;

class InvestorController {
    
    public function __construct() {
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['capital_risque', 'admin'])) {
            header("Location: " . URLROOT . "/auth/login");
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
        $statut = $_GET['statut'] ?? '';
        $sort = $_GET['sort'] ?? 'date_desc';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $projects = $projectModel->getAllActiveProjects($search, $secteur, $statut, $sort, $limit, $offset);
        $totalProjects = $projectModel->countActiveProjects($search, $secteur, $statut);
        $totalPages = ceil($totalProjects / $limit);
        
        $favoriteModel = new Favorite();
        $userFavorites = [];
        if (isset($_SESSION['user_id'])) {
            $favs = $favoriteModel->getFavoritesByInvestor($_SESSION['user_id']);
            $userFavorites = array_column($favs, 'id');
        }

        foreach($projects as &$p) {
            $p['percent_funded'] = round($p['percent_funded']);
            $p['is_favorite'] = in_array($p['id'], $userFavorites);
        }
        
        require __DIR__ . '/../Views/investor/catalog.php';
    }

    public function project() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . URLROOT . "/investor/catalog");
            exit;
        }

        $projectModel = new Project();
        $reviewModel = new Review();
        $investmentModel = new Investment();
        $favoriteModel = new Favorite();
        
        $project = $projectModel->getProjectById($id);
        if (!$project) {
            header("Location: " . URLROOT . "/investor/catalog");
            exit;
        }

        $project['sold_actions'] = $investmentModel->getSoldActionsByProject($id);
        $project['percent_funded'] = round(($project['sold_actions'] / $project['nb_actions']) * 100);
        
        $reviews = $reviewModel->getReviewsByProject($id);
        $avgRating = $reviewModel->getAverageRating($id);

        $is_favorite = false;
        $favorites = $favoriteModel->getFavoritesByInvestor($_SESSION['user_id']);
        foreach($favorites as $fav) {
            if($fav['id'] == $id) {
                $is_favorite = true;
                break;
            }
        }

        require __DIR__ . '/../Views/investor/project.php';
    }

    public function invest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $project_id = $_POST['project_id'];
            $nb_actions_to_buy = (int)$_POST['nb_actions'];
            
            $projectModel = new Project();
            $investmentModel = new Investment();
            
            $project = $projectModel->getProjectById($project_id);
            $sold_actions = $investmentModel->getSoldActionsByProject($project_id);
            $remaining_actions = $project['nb_actions'] - $sold_actions;

            if ($project && $nb_actions_to_buy > 0 && $nb_actions_to_buy <= $remaining_actions) {
                $montant_total = $nb_actions_to_buy * $project['prix_unitaire'];
                
                $data = [
                    'investor_id' => $_SESSION['user_id'],
                    'project_id' => $project_id,
                    'nb_actions' => $nb_actions_to_buy,
                    'montant_total' => $montant_total
                ];
                
                if ($investmentModel->create($data)) {
                    // Check if project should be closed
                    if (($sold_actions + $nb_actions_to_buy) >= $project['nb_actions']) {
                        $projectModel->updateStatus($project_id, 'cloture');
                    }
                    $activityModel = new \App\Models\Activity();
                    $activityModel->log($_SESSION['user_id'], 'investment', "Investissement de " . number_format($montant_total, 2) . " DT dans le projet '{$project['titre']}'");
                    header("Location: " . URLROOT . "/investor/dashboard?success=1");
                    exit;
                }
            } else {
                header("Location: " . URLROOT . "/investor/project?id=" . $project_id . "&error=insufficient_shares");
                exit;
            }
        }
        header("Location: " . URLROOT . "/investor/catalog");
        exit;
    }

    public function toggleFavorite() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $project_id = $_POST['project_id'];
            $favoriteModel = new Favorite();
            $is_favorite = $favoriteModel->toggle($_SESSION['user_id'], $project_id);
            
            // Check if AJAX
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'is_favorite' => $is_favorite]);
                exit;
            }

            $referer = $_SERVER['HTTP_REFERER'] ?? URLROOT . '/investor/catalog';
            header("Location: " . $referer);
            exit;
        }
    }

    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'project_id' => $_POST['project_id'],
                'note' => $_POST['note'],
                'commentaire' => $_POST['commentaire']
            ];

            $reviewModel = new Review();
            $reviewModel->create($data);
            
            header("Location: " . URLROOT . "/investor/project?id=" . $data['project_id']);
            exit;
        }
    }

    public function certificate() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . URLROOT . "/investor/dashboard");
            exit;
        }

        $investmentModel = new Investment();
        $investment = $investmentModel->getInvestmentById($id);

        if (!$investment || $investment['investor_id'] != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/investor/dashboard");
            exit;
        }

        require __DIR__ . '/../Views/investor/certificate.php';
    }
}
