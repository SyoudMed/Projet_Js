<?php
namespace App\Controllers;

use App\Models\Project;
use App\Models\User;

class AdminController {
    
    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . URLROOT . "/auth/login");
            exit;
        }
    }

    public function dashboard() {
        $projectModel = new Project();
        $userModel = new User();
        $investmentModel = new \App\Models\Investment();
        $activityModel = new \App\Models\Activity();

        $projects = $projectModel->getAllProjects();
        $users = $userModel->getAllUsers();
        
        $stats = [
            'total_projects' => count($projects),
            'pending_projects' => count(array_filter($projects, fn($p) => $p['statut'] === 'en_attente')),
            'active_projects' => count(array_filter($projects, fn($p) => $p['statut'] === 'actif')),
            'total_users' => count($users),
            'investors_count' => count(array_filter($users, fn($u) => $u['role'] === 'capital_risque')),
            'startupers_count' => count(array_filter($users, fn($u) => $u['role'] === 'startuper')),
            'total_raised' => $investmentModel->getTotalRaised(),
        ];

        $recentActivities = $activityModel->getRecent(6);
        $topProjects = $projectModel->getTopProjectsOfMonth(5);

        require __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function projects() {
        $search = $_GET['search'] ?? '';
        $statut = $_GET['statut'] ?? '';
        $projectModel = new Project();
        
        $projects = $projectModel->getAllProjects($search, '', $statut);
        require __DIR__ . '/../Views/admin/projects.php';
    }

    public function updateProjectStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];
            
            $projectModel = new Project();
            $project = $projectModel->getProjectById($id);

            if ($projectModel->updateStatus($id, $status)) {
                $activityModel = new \App\Models\Activity();
                $activityModel->log($_SESSION['user_id'], 'project_update', "Statut du projet '{$project['titre']}' changé en '{$status}'");
                header("Location: " . URLROOT . "/admin/projects?success=1");
            } else {
                header("Location: " . URLROOT . "/admin/projects?error=1");
            }
            exit;
        }
    }

    public function users() {
        $search = $_GET['search'] ?? '';
        $role = $_GET['role'] ?? '';
        $userModel = new User();
        
        $users = $userModel->getAllUsers($search, $role);
        require __DIR__ . '/../Views/admin/users.php';
    }

    public function updateUserStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];
            
            $userModel = new User();
            $targetUser = $userModel->getUserById($id);

            if ($userModel->updateStatus($id, $status)) {
                $activityModel = new \App\Models\Activity();
                $actionLabel = ($status === 'bloque') ? 'bloqué' : 'réactivé';
                $activityModel->log($_SESSION['user_id'], 'user_update', "Compte de '{$targetUser['pseudo']}' {$actionLabel}");
                header("Location: " . URLROOT . "/admin/users?success=1");
            } else {
                header("Location: " . URLROOT . "/admin/users?error=1");
            }
            exit;
        }
    }
}
