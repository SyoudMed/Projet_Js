<?php
namespace App\Controllers;

use App\Models\Message;
use App\Models\Project;

class MessagesController {
    
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URLROOT . "/auth/login");
            exit;
        }
    }

    public function index() {
        $messageModel = new Message();
        $all_messages = $messageModel->getConversationsByUser($_SESSION['user_id']);
        
        // Group messages into unique conversations
        $conversations = [];
        foreach ($all_messages as $msg) {
            $user_id = (int)$_SESSION['user_id'];
            $msg_sender_id = (int)$msg['sender_id'];
            $msg_receiver_id = (int)$msg['receiver_id'];

            $other_id = ($msg_sender_id === $user_id) ? $msg_receiver_id : $msg_sender_id;
            $other_name = ($msg_sender_id === $user_id) ? $msg['receiver_name'] : $msg['sender_name'];
            
            $proj_id_key = ($msg['project_id'] === null) ? 'support' : $msg['project_id'];
            $key = $proj_id_key . '_' . $other_id;

            if (!isset($conversations[$key])) {
                $conversations[$key] = [
                    'project_id' => ($msg['project_id'] === null) ? 'null' : $msg['project_id'],
                    'project_title' => $msg['project_title'] ?: 'Support StartuPInvest',
                    'other_id' => $other_id,
                    'other_name' => $other_name,
                    'last_message' => $msg['contenu'],
                    'date' => $msg['created_at'],
                    'has_unread' => false
                ];
            }
            
            if ($msg_receiver_id === $user_id && $msg['is_read'] == 0) {
                $conversations[$key]['has_unread'] = true;
            }
        }

        require __DIR__ . '/../Views/messages/index.php';
    }

    public function chat() {
        $project_id = isset($_GET['project_id']) ? $_GET['project_id'] : null;
        $other_id = isset($_GET['other_id']) ? $_GET['other_id'] : null;

        if ($project_id === null || $other_id === null) {
            header("Location: " . URLROOT . "/messages");
            exit;
        }

        $messageModel = new Message();
        $projectModel = new Project();
        
        $messages = $messageModel->getMessagesByProject($project_id, $_SESSION['user_id'], $other_id);
        $messageModel->markAsRead($project_id, $_SESSION['user_id'], $other_id);
        
        if ($project_id === 'null' || $project_id == 0) {
            $project = [
                'id' => 'null',
                'titre' => 'Support StartuPInvest',
                'prenom' => 'Administrateur',
                'nom' => '',
                'startuper_id' => 1
            ];
        } else {
            $project = $projectModel->getProjectById($project_id);
            if (!$project) {
                $project = [
                    'id' => 'null',
                    'titre' => 'Support StartuPInvest',
                    'prenom' => 'Administrateur',
                    'nom' => '',
                    'startuper_id' => 1
                ];
            }
        }

        require __DIR__ . '/../Views/messages/chat.php';
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'sender_id' => $_SESSION['user_id'],
                'receiver_id' => $_POST['receiver_id'],
                'project_id' => ($_POST['project_id'] === 'null' || $_POST['project_id'] == 0) ? null : $_POST['project_id'],
                'contenu' => $_POST['contenu']
            ];

            $messageModel = new Message();
            if ($messageModel->create($data)) {
                $redirect_proj_id = ($data['project_id'] === null) ? 'null' : $data['project_id'];
                header("Location: " . URLROOT . "/messages/chat?project_id=" . $redirect_proj_id . "&other_id=" . $data['receiver_id']);
            } else {
                header("Location: " . URLROOT . "/messages?error=1");
            }
            exit;
        }
    }
}
