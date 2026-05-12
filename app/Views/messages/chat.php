<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/messages" class="btn btn-sm btn-light border-custom"><i class="fa-solid fa-arrow-left me-2"></i>Retour aux messages</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="saas-card border-0 d-flex flex-column" style="height: 600px;">
                <!-- Header -->
                <div class="bg-surface px-4 py-3 border-bottom border-custom d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-main mb-0"><?= htmlspecialchars($other_id == $project['startuper_id'] ? $project['prenom'] . ' ' . $project['nom'] : 'Utilisateur') ?></h6>
                        <small class="text-muted-custom"><?= htmlspecialchars($project['titre']) ?></small>
                    </div>
                </div>

                <!-- Messages Area -->
                <div class="flex-grow-1 overflow-auto p-4 bg-bg-color" id="chat-messages">
                    <?php if(empty($messages)): ?>
                        <div class="text-center py-5 opacity-50">
                            <p>Envoyez un message pour commencer la discussion.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach($messages as $msg): ?>
                            <div class="d-flex mb-4 <?= $msg['sender_id'] == $_SESSION['user_id'] ? 'justify-content-end' : '' ?>">
                                <div style="max-width: 75%;">
                                    <div class="p-3 rounded-4 <?= $msg['sender_id'] == $_SESSION['user_id'] ? 'bg-primary text-white' : 'bg-surface border border-custom text-main' ?>">
                                        <?= htmlspecialchars($msg['contenu']) ?>
                                    </div>
                                    <div class="small text-muted-custom mt-1 <?= $msg['sender_id'] == $_SESSION['user_id'] ? 'text-end' : '' ?>">
                                        <?= date('H:i', strtotime($msg['created_at'])) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Input Area -->
                <div class="p-3 bg-surface border-top border-custom">
                    <form method="POST" action="<?= URLROOT ?>/messages/send" class="d-flex gap-2">
                        <input type="hidden" name="project_id" value="<?= $project_id ?>">
                        <input type="hidden" name="receiver_id" value="<?= $other_id ?>">
                        <input type="text" name="contenu" class="form-control bg-bg-color border-custom" placeholder="Tapez votre message..." required autofocus autocomplete="off">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Auto-scroll to bottom of chat
    const chatMessages = document.getElementById('chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
