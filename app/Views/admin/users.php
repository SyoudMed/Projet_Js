<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/admin/dashboard" class="btn btn-sm btn-light border-custom"><i class="fa-solid fa-arrow-left me-2"></i>Retour au tableau de bord</a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Gestion des Utilisateurs</h2>
            <p class="text-muted-custom mb-0">Activez ou bloquez les comptes Startuper et Investisseur.</p>
        </div>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>Action effectuée avec succès.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="saas-card border-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-saas table-borderless align-middle mb-0">
                <thead>
                    <tr class="bg-surface">
                        <th class="ps-4">Utilisateur</th>
                        <th>Rôle</th>
                        <th>Email</th>
                        <th>Entreprise / CIN</th>
                        <th>Statut</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted-custom">Aucun utilisateur trouvé.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($users as $u): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-main"><?= htmlspecialchars($u['prenom'] . ' ' . $u['nom']) ?></div>
                                <div class="small text-muted-custom">@<?= htmlspecialchars($u['pseudo']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light border border-custom text-muted-custom"><?= htmlspecialchars($u['role']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td>
                                <?php if($u['role'] === 'startuper'): ?>
                                    <div class="small fw-bold text-main"><?= htmlspecialchars($u['nom_entreprise']) ?></div>
                                <?php else: ?>
                                    <div class="small text-muted-custom"><?= htmlspecialchars($u['cin']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($u['statut'] === 'actif'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 border border-success border-opacity-25">Actif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 border border-danger border-opacity-25">Bloqué</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <form method="POST" action="<?= URLROOT ?>/admin/updateUserStatus">
                                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                        <?php if($u['statut'] === 'actif'): ?>
                                            <input type="hidden" name="status" value="bloque">
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3" title="Bloquer">
                                                <i class="fa-solid fa-user-slash"></i> Bloquer
                                            </button>
                                        <?php else: ?>
                                            <input type="hidden" name="status" value="actif">
                                            <button type="submit" class="btn btn-sm btn-success px-3" title="Activer">
                                                <i class="fa-solid fa-user-check"></i> Activer
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
