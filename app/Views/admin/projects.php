<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="mb-4">
        <a href="<?= URLROOT ?>/admin/dashboard" class="btn btn-sm btn-light border-custom"><i class="fa-solid fa-arrow-left me-2"></i>Retour au tableau de bord</a>
    </div>

    <div class="row align-items-end mb-5 pb-3 border-bottom border-custom">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-1">Modération des Projets</h2>
            <p class="text-muted-custom mb-0">Approuvez ou suspendez les campagnes de financement.</p>
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
            <form method="GET" action="<?= URLROOT ?>/admin/projects" class="row g-2 justify-content-lg-end">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-surface border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-search"></i></span>
                        <input type="text" name="search" class="form-control bg-surface border-start-0 ps-0" placeholder="Rechercher..." value="<?= htmlspecialchars($search ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="statut" class="form-select bg-surface border-custom">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" <?= ($statut === 'en_attente') ? 'selected' : '' ?>>En attente</option>
                        <option value="actif" <?= ($statut === 'actif') ? 'selected' : '' ?>>Actif</option>
                        <option value="suspendu" <?= ($statut === 'suspendu') ? 'selected' : '' ?>>Suspendu</option>
                        <option value="rejete" <?= ($statut === 'rejete') ? 'selected' : '' ?>>Rejeté</option>
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
                    <strong class="d-block">Succès!</strong>
                    L'action a été appliquée au projet.
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
                        <th class="ps-4 py-3">Projet</th>
                        <th class="py-3">Startuper / Entreprise</th>
                        <th class="py-3">Secteur</th>
                        <th class="py-3">Objectif</th>
                        <th class="py-3">Statut</th>
                        <th class="text-end pe-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($projects)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="opacity-25 mb-3"><i class="fa-solid fa-folder-open fa-3x"></i></div>
                                <p class="text-muted-custom italic">Aucun projet ne correspond à votre recherche.</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($projects as $p): ?>
                        <tr class="border-bottom border-custom">
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; flex-shrink: 0;">
                                        <?php if($p['image_path']): ?>
                                            <img src="<?= URLROOT . $p['image_path'] ?>" class="w-100 h-100 object-fit-cover rounded-3">
                                        <?php else: ?>
                                            <i class="fa-solid fa-rocket text-primary opacity-50"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-main"><?= htmlspecialchars($p['titre']) ?></div>
                                        <div class="small text-muted-custom">Créé le <?= date('d/m/Y', strtotime($p['created_at'])) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium text-main"><?= htmlspecialchars($p['prenom'] . ' ' . $p['nom']) ?></div>
                                <div class="small text-muted-custom text-uppercase fw-semibold" style="font-size: 0.7rem;"><?= htmlspecialchars($p['nom_entreprise']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light border border-custom text-muted-custom fw-medium"><?= htmlspecialchars($p['secteur']) ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-success"><?= number_format($p['nb_actions'] * $p['prix_unitaire'], 2) ?> DT</div>
                                <div class="small text-muted-custom"><?= number_format($p['nb_actions']) ?> parts</div>
                            </td>
                            <td>
                                <?php if($p['statut'] === 'en_attente'): ?>
                                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 border border-warning border-opacity-25 rounded-pill"><i class="fa-solid fa-hourglass-start me-1"></i>En attente</span>
                                <?php elseif($p['statut'] === 'actif'): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 border border-success border-opacity-25 rounded-pill"><i class="fa-solid fa-check-circle me-1"></i>Actif</span>
                                <?php elseif($p['statut'] === 'rejete'): ?>
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 border border-danger border-opacity-25 rounded-pill"><i class="fa-solid fa-circle-xmark me-1"></i>Rejeté</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 border border-secondary border-opacity-25 rounded-pill"><?= ucfirst($p['statut']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <?php if($p['statut'] === 'en_attente' || $p['statut'] === 'rejete' || $p['statut'] === 'suspendu'): ?>
                                        <form method="POST" action="<?= URLROOT ?>/admin/updateProjectStatus" onsubmit="return confirm('Approuver ce projet ?');">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="status" value="actif">
                                            <button type="submit" class="btn btn-sm btn-success rounded-3 px-3 shadow-sm" title="Approuver">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <?php if($p['statut'] === 'en_attente'): ?>
                                        <form method="POST" action="<?= URLROOT ?>/admin/updateProjectStatus" onsubmit="return confirm('Rejeter ce projet ?');">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="status" value="rejete">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-3" title="Rejeter">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php if($p['statut'] === 'actif'): ?>
                                        <form method="POST" action="<?= URLROOT ?>/admin/updateProjectStatus" onsubmit="return confirm('Suspendre ce projet ?');">
                                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                            <input type="hidden" name="status" value="suspendu">
                                            <button type="submit" class="btn btn-sm btn-outline-warning rounded-3 px-3" title="Suspendre">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <a href="<?= URLROOT ?>/investor/project?id=<?= $p['id'] ?>" class="btn btn-sm btn-light border-custom rounded-3 px-3" title="Aperçu">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
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
