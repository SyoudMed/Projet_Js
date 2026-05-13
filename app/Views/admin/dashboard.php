<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Administration</h2>
            <p class="text-muted-custom mb-0">Vue d'ensemble de la plateforme StartuPInvest.</p>
        </div>
        <a href="<?= URLROOT ?>/admin/projects" class="btn btn-primary shadow-sm">
            <i class="fa-solid fa-list-check me-2"></i>Modérer les projets
        </a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-rocket fs-4"></i>
                    </div>
                    <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Total Projets</h6>
                    <h2 class="fw-bold mb-0 text-main"><?= $stats['total_projects'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-clock fs-4"></i>
                    </div>
                    <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">En Attente</h6>
                    <h2 class="fw-bold mb-0 text-main"><?= $stats['pending_projects'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 text-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-check-double fs-4"></i>
                    </div>
                    <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Projets Actifs</h6>
                    <h2 class="fw-bold mb-0 text-main"><?= $stats['active_projects'] ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="saas-card border-0 mb-5">
        <div class="bg-surface px-4 py-3 border-bottom border-custom">
            <h5 class="fw-semibold mb-0">Raccourcis Administrateur</h5>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <a href="<?= URLROOT ?>/admin/projects" class="btn bg-bg-color border-custom w-100 text-start p-3 hover-elevate">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-folder-open fs-4 text-primary me-3"></i>
                            <div>
                                <div class="fw-bold text-main">Gestion des Projets</div>
                                <div class="small text-muted-custom">Approuver, suspendre ou clôturer des campagnes.</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="<?= URLROOT ?>/admin/users" class="btn bg-bg-color border-custom w-100 text-start p-3 hover-elevate">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-users-gear fs-4 text-primary me-3"></i>
                            <div>
                                <div class="fw-bold text-main">Gestion Utilisateurs</div>
                                <div class="small text-muted-custom">Gérer les comptes Startuper et Investisseur.</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
