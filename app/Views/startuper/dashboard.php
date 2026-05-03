<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Tableau de bord Startuper</h2>
        <a href="/js_project/public/startuper/create" class="btn btn-primary shadow-sm hover-elevate">
            <i class="fa-solid fa-plus me-2"></i>Nouveau Projet
        </a>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card text-center glass-panel shadow-sm border-0">
                <div class="card-body py-4">
                    <h5 class="text-muted-custom">Mes Projets</h5>
                    <h2 class="display-5 fw-bold text-gradient"><?= $totalProjects ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center glass-panel shadow-sm border-0">
                <div class="card-body py-4">
                    <h5 class="text-muted-custom">Fonds Collectés</h5>
                    <h2 class="display-5 fw-bold text-success">0 DT</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center glass-panel shadow-sm border-0">
                <div class="card-body py-4">
                    <h5 class="text-muted-custom">Investisseurs</h5>
                    <h2 class="display-5 fw-bold text-info">0</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm glass-panel border-0 mb-5">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="mb-0">Liste de vos projets</h5>
        </div>
        <div class="card-body p-4">
            <?php if(empty($projects)): ?>
                <div class="text-center py-5 text-muted-custom">
                    <i class="fa-solid fa-folder-open fa-3x mb-3 text-secondary opacity-50"></i>
                    <p class="fs-5">Vous n'avez pas encore publié de projets.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Titre</th>
                                <th>Secteur</th>
                                <th>Objectif</th>
                                <th>Statut</th>
                                <th>Date limite</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($projects as $p): ?>
                            <tr>
                                <td class="fw-semibold"><?= htmlspecialchars($p['titre']) ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($p['secteur']) ?></span></td>
                                <td><?= number_format($p['nb_actions'] * $p['prix_unitaire'], 2) ?> DT</td>
                                <td>
                                    <?php if($p['statut'] === 'en_attente'): ?>
                                        <span class="badge bg-warning text-dark"><i class="fa-solid fa-hourglass-half me-1"></i>En attente</span>
                                    <?php elseif($p['statut'] === 'actif'): ?>
                                        <span class="badge bg-success"><i class="fa-solid fa-check me-1"></i>Actif</span>
                                    <?php elseif($p['statut'] === 'suspendu'): ?>
                                        <span class="badge bg-danger"><i class="fa-solid fa-ban me-1"></i>Suspendu</span>
                                    <?php elseif($p['statut'] === 'cloture'): ?>
                                        <span class="badge bg-secondary"><i class="fa-solid fa-lock me-1"></i>Clôturé</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($p['date_limite']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-eye"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
