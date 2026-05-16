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
            if ($user === 'blocked') {
                $error = "Votre compte a été suspendu par l'administrateur.";
            } elseif ($user) {
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

    public function profile() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/auth/login");
            exit;
        }

        $userModel = new User();
        $user = $userModel->getUserById($_SESSION['user_id']);
        
        require __DIR__ . '/../Views/auth/profile.php';
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $id = $_SESSION['user_id'];
            
            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'pseudo' => $_POST['pseudo'],
                'nom_entreprise' => $_POST['nom_entreprise'] ?? '',
                'adresse_entreprise' => $_POST['adresse_entreprise'] ?? ''
            ];

            if ($userModel->update($id, $data)) {
                $_SESSION['pseudo'] = $data['pseudo']; // Update session
                header("Location: " . URLROOT . "/auth/profile?success=1");
            } else {
                header("Location: " . URLROOT . "/auth/profile?error=1");
            }
            exit;
        }
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $id = $_SESSION['user_id'];
            $current_password = $_POST['current_password'];
            $new_password = $_POST['new_password'];

            $user = $userModel->getUserById($id);
            if (password_verify($current_password, $user['password'])) {
                $userModel->updatePassword($id, $new_password);
                header("Location: " . URLROOT . "/auth/profile?success_pw=1");
            } else {
                header("Location: " . URLROOT . "/auth/profile?error_pw=1");
            }
            exit;
        }
    }
}
