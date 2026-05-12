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
            $other_id = ($msg['sender_id'] == $_SESSION['user_id']) ? $msg['receiver_id'] : $msg['sender_id'];
            $other_name = ($msg['sender_id'] == $_SESSION['user_id']) ? $msg['receiver_name'] : $msg['sender_name'];
            
            $key = $msg['project_id'] . '_' . $other_id;
            if (!isset($conversations[$key])) {
                $conversations[$key] = [
                    'project_id' => $msg['project_id'],
                    'project_title' => $msg['project_title'],
                    'other_id' => $other_id,
                    'other_name' => $other_name,
                    'last_message' => $msg['contenu'],
                    'date' => $msg['created_at']
                ];
            }
        }

        require __DIR__ . '/../Views/messages/index.php';
    }

    public function chat() {
        $project_id = $_GET['project_id'] ?? null;
        $other_id = $_GET['other_id'] ?? null;

        if (!$project_id || !$other_id) {
            header("Location: " . URLROOT . "/messages");
            exit;
        }

        $messageModel = new Message();
        $projectModel = new Project();
        
        $messages = $messageModel->getMessagesByProject($project_id, $_SESSION['user_id'], $other_id);
        $project = $projectModel->getProjectById($project_id);

        require __DIR__ . '/../Views/messages/chat.php';
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'sender_id' => $_SESSION['user_id'],
                'receiver_id' => $_POST['receiver_id'],
                'project_id' => $_POST['project_id'],
                'contenu' => $_POST['contenu']
            ];

            $messageModel = new Message();
            if ($messageModel->create($data)) {
                header("Location: " . URLROOT . "/messages/chat?project_id=" . $data['project_id'] . "&other_id=" . $data['receiver_id']);
            } else {
                header("Location: " . URLROOT . "/messages?error=1");
            }
            exit;
        }
    }
}
