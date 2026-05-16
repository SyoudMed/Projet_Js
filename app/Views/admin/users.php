<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/admin/dashboard" class="btn btn-sm btn-light border-custom"><i class="fa-solid fa-arrow-left me-2"></i>Retour au tableau de bord</a>
    </div>

    <div class="row align-items-end mb-5 pb-3 border-bottom border-custom">
        <div class="col-lg-5">
            <h2 class="fw-bold mb-1">Gestion des Utilisateurs</h2>
            <p class="text-muted-custom mb-0">Activez ou bloquez les comptes de la plateforme.</p>
        </div>
        <div class="col-lg-7 mt-4 mt-lg-0">
            <form method="GET" action="<?= URLROOT ?>/admin/users" class="row g-2 justify-content-lg-end">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-surface border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-search"></i></span>
                        <input type="text" name="search" class="form-control bg-surface border-start-0 ps-0" placeholder="Nom, email, pseudo..." value="<?= htmlspecialchars($search ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="role" class="form-select bg-surface border-custom">
                        <option value="">Tous les rôles</option>
                        <option value="capital_risque" <?= ($role === 'capital_risque') ? 'selected' : '' ?>>Investisseurs</option>
                        <option value="startuper" <?= ($role === 'startuper') ? 'selected' : '' ?>>Startupers</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-check fs-4 me-3"></i>
                <div>
                    <strong>Action réussie!</strong> Le statut du compte a été mis à jour.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="saas-card border-0 overflow-hidden shadow-sm">
        <div class="table-responsive">
            <table class="table table-saas table-borderless align-middle mb-0">
                <thead>
                    <tr class="bg-surface">
                        <th class="ps-4 py-3">Utilisateur</th>
                        <th class="py-3">Rôle</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Identité / Entreprise</th>
                        <th class="py-3">Statut</th>
                        <th class="text-end pe-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fa-solid fa-users-slash display-4 opacity-25 mb-3 d-block"></i>
                                <p class="text-muted-custom">Aucun utilisateur ne correspond à vos critères.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($users as $u): ?>
                        <tr class="border-bottom border-custom">
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-main"><?= htmlspecialchars($u['prenom'] . ' ' . $u['nom']) ?></div>
                                        <div class="small text-muted-custom">Inscrit le <?= date('d/m/Y', strtotime($u['created_at'])) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($u['role'] === 'startuper'): ?>
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-2">
                                        <i class="fa-solid fa-rocket me-1"></i>Startuper
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">
                                        <i class="fa-solid fa-wallet me-1"></i>Investisseur
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="small text-main fw-medium"><?= htmlspecialchars($u['email']) ?></div>
                                <div class="small text-muted-custom">@<?= htmlspecialchars($u['pseudo']) ?></div>
                            </td>
                            <td>
                                <?php if($u['role'] === 'startuper'): ?>
                                    <div class="fw-bold text-main small"><?= htmlspecialchars($u['nom_entreprise']) ?></div>
                                    <div class="text-muted-custom small" style="font-size: 0.7rem;">SIRET/ID: <?= htmlspecialchars($u['id'] + 1000) ?></div>
                                <?php else: ?>
                                    <div class="fw-medium text-main small">CIN: <?= htmlspecialchars($u['cin']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($u['statut'] === 'actif'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill"><i class="fa-solid fa-check-circle me-1"></i>Actif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill"><i class="fa-solid fa-ban me-1"></i>Bloqué</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <form method="POST" action="<?= URLROOT ?>/admin/updateUserStatus" onsubmit="return confirm('Confirmer le changement de statut pour cet utilisateur ?');">
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                    <?php if($u['statut'] === 'actif'): ?>
                                        <input type="hidden" name="status" value="bloque">
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold">
                                            <i class="fa-solid fa-user-slash me-1"></i>Bloquer
                                        </button>
                                    <?php else: ?>
                                        <input type="hidden" name="status" value="actif">
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm">
                                            <i class="fa-solid fa-user-check me-1"></i>Réactiver
                                        </button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<style>
    .bg-indigo-custom { background-color: #6366f1; }
    .text-indigo-custom { color: #6366f1; }
    .border-indigo-custom { border-color: #6366f1; }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
