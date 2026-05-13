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
        $projects = $projectModel->getAllProjects();
        
        $stats = [
            'total_projects' => count($projects),
            'pending_projects' => count(array_filter($projects, fn($p) => $p['statut'] === 'en_attente')),
            'active_projects' => count(array_filter($projects, fn($p) => $p['statut'] === 'actif'))
        ];

        require __DIR__ . '/../Views/admin/dashboard.php';
    }

    public function projects() {
        $projectModel = new Project();
        $projects = $projectModel->getAllProjects();
        require __DIR__ . '/../Views/admin/projects.php';
    }

    public function updateProjectStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];
            
            $projectModel = new Project();
            if ($projectModel->updateStatus($id, $status)) {
                header("Location: " . URLROOT . "/admin/projects?success=1");
            } else {
                header("Location: " . URLROOT . "/admin/projects?error=1");
            }
        }
    }

    public function users() {
        $userModel = new User();
        $users = $userModel->getAllUsers();
        require __DIR__ . '/../Views/admin/users.php';
    }

    public function updateUserStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];
            
            $userModel = new User();
            if ($userModel->updateStatus($id, $status)) {
                header("Location: " . URLROOT . "/admin/users?success=1");
            } else {
                header("Location: " . URLROOT . "/admin/users?error=1");
            }
            exit;
        }
    }
}
