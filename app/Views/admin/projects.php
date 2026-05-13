<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/admin/dashboard" class="btn btn-sm btn-light border-custom"><i class="fa-solid fa-arrow-left me-2"></i>Retour au tableau de bord</a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Modération des Projets</h2>
            <p class="text-muted-custom mb-0">Approuvez ou suspendez les campagnes de financement.</p>
        </div>
        <form method="GET" action="<?= URLROOT ?>/admin/projects" class="d-flex gap-2">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-surface border-custom border-end-0"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" class="form-control bg-surface border-start-0" placeholder="Rechercher..." value="<?= htmlspecialchars($search ?? '') ?>" style="width: 200px;">
            </div>
            <button type="submit" class="btn btn-sm btn-primary px-3">Filtrer</button>
        </form>
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
                        <th class="ps-4">Projet</th>
                        <th>Startuper / Entreprise</th>
                        <th>Secteur</th>
                        <th>Objectif</th>
                        <th>Statut</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($projects)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted-custom">Aucun projet trouvé.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($projects as $p): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-main"><?= htmlspecialchars($p['titre']) ?></div>
                                <div class="small text-muted-custom">Créé le <?= date('d/m/Y', strtotime($p['created_at'])) ?></div>
                            </td>
                            <td>
                                <div class="fw-medium text-main"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></div>
                                <div class="small text-muted-custom"><?= htmlspecialchars($p['nom_entreprise']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light border border-custom text-muted-custom"><?= htmlspecialchars($p['secteur']) ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-success"><?= number_format($p['nb_actions'] * $p['prix_unitaire'], 2) ?> DT</div>
                                <div class="small text-muted-custom"><?= number_format($p['nb_actions']) ?> actions</div>
                            </td>
                            <td>
                                <?php if($p['statut'] === 'en_attente'): ?>
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 border border-warning border-opacity-25">En attente</span>
                                <?php elseif($p['statut'] === 'actif'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 border border-success border-opacity-25">Actif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 border border-secondary border-opacity-25"><?= ucfirst($p['statut']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <?php if($p['statut'] !== 'actif'): ?>
                                        <form method="POST" action="<?= URLROOT ?>/admin/updateProjectStatus">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="status" value="actif">
                                            <button type="submit" class="btn btn-sm btn-success px-3" title="Approuver">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <?php if($p['statut'] !== 'suspendu'): ?>
                                        <form method="POST" action="<?= URLROOT ?>/admin/updateProjectStatus">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="status" value="suspendu">
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3" title="Suspendre">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
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
