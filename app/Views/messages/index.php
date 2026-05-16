<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Messages</h2>
            <p class="text-muted-custom mb-0">Discutez avec les fondateurs ou les investisseurs.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="saas-card border-0 overflow-hidden">
                <?php if(empty($conversations)): ?>
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-regular fa-comments fs-2 text-muted-custom"></i>
                        </div>
                        <p class="text-muted-custom">Vous n'avez pas encore de conversations.</p>
                    </div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach($conversations as $conv): ?>
                            <a href="<?= URLROOT ?>/messages/chat?project_id=<?= $conv['project_id'] ?>&other_id=<?= $conv['other_id'] ?>" 
                               class="list-group-item list-group-item-action bg-surface border-custom px-4 py-4 hover-elevate">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-main mb-1"><?= htmlspecialchars($conv['other_name']) ?></h6>
                                            <div class="small text-primary mb-1"><?= htmlspecialchars($conv['project_title']) ?></div>
                                            <div class="small text-muted-custom text-truncate" style="max-width: 300px;">
                                                <?= htmlspecialchars($conv['last_message']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="mb-1">
                                            <small class="text-muted-custom"><?= date('d M, H:i', strtotime($conv['date'])) ?></small>
                                        </div>
                                        <?php if($conv['has_unread']): ?>
                                            <span class="badge rounded-pill bg-danger">Nouveau</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
