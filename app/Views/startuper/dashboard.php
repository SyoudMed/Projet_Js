<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Tableau de bord Startuper</h2>
            <p class="text-muted-custom mb-0">Bienvenue, gérez vos campagnes de financement.</p>
        </div>
        <a href="/js_project/public/startuper/create" class="btn btn-primary shadow-sm hover-elevate px-4">
            <i class="fa-solid fa-plus me-2"></i>Nouveau Projet
        </a>
    </div>

    <div class="row mb-5 g-4">
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-rocket fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Mes Projets</h6>
                        <h2 class="fw-bold mb-0 text-main"><?= $totalProjects ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-coins fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Fonds Collectés</h6>
                        <h2 class="fw-bold mb-0 text-main">0 DT</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-users fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Investisseurs</h6>
                        <h2 class="fw-bold mb-0 text-main">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="saas-card border-0 mb-5 overflow-hidden">
        <div class="bg-surface px-4 py-3 border-bottom border-custom d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold mb-0">Liste de vos projets</h5>
        </div>
        <div class="p-0">
            <?php if(empty($projects)): ?>
                <div class="text-center py-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-muted rounded-circle mb-3" style="width: 80px; height: 80px;">
                        <i class="fa-solid fa-folder-open fs-2"></i>
                    </div>
                    <p class="fs-5 text-muted-custom">Vous n'avez pas encore publié de projets.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-saas table-borderless align-middle w-100">
                        <thead>
                            <tr>
                                <th>Projet</th>
                                <th>Secteur</th>
                                <th>Objectif (DT)</th>
                                <th>Statut</th>
                                <th>Date limite</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($projects as $p): ?>
                            <tr>
                                <td class="fw-medium text-main"><?= htmlspecialchars($p['titre']) ?></td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-muted-custom border border-secondary border-opacity-25 px-2 py-1"><?= htmlspecialchars($p['secteur']) ?></span></td>
                                <td class="fw-medium"><?= number_format($p['nb_actions'] * $p['prix_unitaire'], 2) ?></td>
                                <td>
                                    <?php if($p['statut'] === 'en_attente'): ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1"><i class="fa-solid fa-hourglass-half me-1"></i>En attente</span>
                                    <?php elseif($p['statut'] === 'actif'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1"><i class="fa-solid fa-check me-1"></i>Actif</span>
                                    <?php elseif($p['statut'] === 'suspendu'): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1"><i class="fa-solid fa-ban me-1"></i>Suspendu</span>
                                    <?php elseif($p['statut'] === 'cloture'): ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1"><i class="fa-solid fa-lock me-1"></i>Clôturé</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted-custom"><?= htmlspecialchars($p['date_limite']) ?></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-light text-muted-custom border border-custom me-1 hover-elevate"><i class="fa-solid fa-eye"></i></button>
                                    <button class="btn btn-sm btn-light text-muted-custom border border-custom hover-elevate"><i class="fa-solid fa-pen"></i></button>
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
