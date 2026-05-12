<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {
    
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $pseudo = $_POST['pseudo'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $userModel->login($pseudo, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['role'] = $user['role'];
                
                if ($user['role'] === 'startuper') {
                    header("Location: " . URLROOT . "/startuper/dashboard");
                } elseif ($user['role'] === 'capital_risque') {
                    header("Location: " . URLROOT . "/investor/dashboard");
                } else {
                    header("Location: " . URLROOT . "/admin/dashboard");
                }
                exit;
            } else {
                $error = "Identifiants incorrects.";
            }
        }
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function registerStartuper() {
        $this->handleRegistration('startuper');
    }

    public function registerInvestor() {
        $this->handleRegistration('capital_risque');
    }

    private function handleRegistration($role) {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'cin' => $_POST['cin'] ?? null,
                'email' => $_POST['email'] ?? '',
                'pseudo' => $_POST['pseudo'] ?? '',
                'password' => $_POST['password'] ?? '',
                'role' => $role,
                'nom_entreprise' => $_POST['nom_entreprise'] ?? null,
                'adresse_entreprise' => $_POST['adresse_entreprise'] ?? null,
                'registre_commerce' => $_POST['registre_commerce'] ?? null
            ];

            if ($userModel->checkExists($data['email'], $data['pseudo'])) {
                $error = "L'email ou le pseudo existe déjà.";
            } else {
                if ($userModel->create($data)) {
                    // Log the user in
                    $user = $userModel->login($data['pseudo'], $data['password']);
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['pseudo'] = $user['pseudo'];
                    $_SESSION['role'] = $user['role'];
                    
                    $redirect = $role === 'startuper' ? URLROOT . '/startuper/dashboard' : URLROOT . '/investor/dashboard';
                    header("Location: " . $redirect);
                    exit;
                } else {
                    $error = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
            }
        }
        
        if ($role === 'startuper') {
            require __DIR__ . '/../Views/auth/registerStartuper.php';
        } else {
            require __DIR__ . '/../Views/auth/registerInvestor.php';
        }
    }

    public function logout() {
        session_destroy();
        header("Location: " . URLROOT . "/");
        exit;
    }
}
