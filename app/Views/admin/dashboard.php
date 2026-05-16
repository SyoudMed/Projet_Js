<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Administration</h2>
            <p class="text-muted-custom mb-0">Centre de contrôle global de la plateforme.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= URLROOT ?>/admin/projects" class="btn btn-outline-primary border-custom rounded-pill">
                <i class="fa-solid fa-list-check me-2"></i>Modérer
            </a>
            <a href="<?= URLROOT ?>/admin/users" class="btn btn-primary shadow-sm rounded-pill">
                <i class="fa-solid fa-users me-2"></i>Utilisateurs
            </a>
        </div>
    </div>

    <!-- Financial Summary -->
    <div class="saas-card border-0 mb-4 bg-primary text-white overflow-hidden position-relative">
        <div class="card-body p-5 position-relative z-1">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="text-white text-opacity-75 text-uppercase small fw-bold mb-2">Total des capitaux levés</h6>
                    <h1 class="display-4 fw-bold mb-0"><?= number_format($stats['total_raised'], 2) ?> DT</h1>
                    <p class="mb-0 mt-2 text-white text-opacity-75">Flux financier total circulant sur la plateforme.</p>
                </div>
                <div class="col-md-4 text-md-end mt-4 mt-md-0">
                    <div class="bg-white bg-opacity-20 rounded-4 p-4 d-inline-block backdrop-blur">
                        <i class="fa-solid fa-chart-line display-5 text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute top-0 end-0 bg-white opacity-10 rounded-circle" style="width: 300px; height: 300px; transform: translate(30%, -30%);"></div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Stats Cards -->
        <div class="col-md-3">
            <div class="saas-card border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2">
                            <i class="fa-solid fa-users fs-5"></i>
                        </div>
                        <h6 class="text-muted-custom text-uppercase small fw-bold mb-0">Utilisateurs</h6>
                    </div>
                    <h3 class="fw-bold mb-1 text-main"><?= $stats['total_users'] ?></h3>
                    <div class="small text-muted-custom">
                        <span class="text-primary"><?= $stats['investors_count'] ?></span> inv. | <span class="text-primary"><?= $stats['startupers_count'] ?></span> start.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="saas-card border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-2">
                            <i class="fa-solid fa-hourglass-half fs-5"></i>
                        </div>
                        <h6 class="text-muted-custom text-uppercase small fw-bold mb-0">En Attente</h6>
                    </div>
                    <h3 class="fw-bold mb-1 text-main"><?= $stats['pending_projects'] ?></h3>
                    <div class="small text-muted-custom">Projets nécessitant une validation.</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="saas-card border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-2">
                            <i class="fa-solid fa-circle-check fs-5"></i>
                        </div>
                        <h6 class="text-muted-custom text-uppercase small fw-bold mb-0">Actifs</h6>
                    </div>
                    <h3 class="fw-bold mb-1 text-main"><?= $stats['active_projects'] ?></h3>
                    <div class="small text-muted-custom">Campagnes de levée en cours.</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="saas-card border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-secondary bg-opacity-10 text-secondary rounded-3 p-2">
                            <i class="fa-solid fa-rocket fs-5"></i>
                        </div>
                        <h6 class="text-muted-custom text-uppercase small fw-bold mb-0">Total Projets</h6>
                    </div>
                    <h3 class="fw-bold mb-1 text-main"><?= $stats['total_projects'] ?></h3>
                    <div class="small text-muted-custom">Toutes phases confondues.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Top Projects (F16) -->
        <div class="col-lg-7">
            <div class="saas-card border-0 h-100">
                <div class="px-4 py-3 border-bottom border-custom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Top 5 Projets du Mois (F16)</h5>
                    <span class="badge bg-light text-muted-custom border border-custom fw-medium">Performance</span>
                </div>
                <div class="p-0">
                    <div class="table-responsive">
                        <table class="table table-saas align-middle mb-0">
                            <thead class="bg-surface small text-uppercase">
                                <tr>
                                    <th class="ps-4">Projet</th>
                                    <th>Levée du mois</th>
                                    <th class="text-end pe-4">Tendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($topProjects)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted-custom italic">Aucune donnée de performance pour ce mois.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($topProjects as $index => $tp): ?>
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="fw-bold text-primary me-3 fs-5">#<?= $index + 1 ?></div>
                                                    <div>
                                                        <div class="fw-bold text-main"><?= htmlspecialchars($tp['titre']) ?></div>
                                                        <div class="small text-muted-custom"><?= htmlspecialchars($tp['nom_entreprise']) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-success"><?= number_format($tp['total_raised_month'], 2) ?> DT</div>
                                            </td>
                                            <td class="text-end pe-4">
                                                <span class="text-success small"><i class="fa-solid fa-arrow-up me-1"></i>Vif succès</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="col-lg-5">
            <div class="saas-card border-0 h-100">
                <div class="px-4 py-3 border-bottom border-custom">
                    <h5 class="fw-bold mb-0">Journal d'Activité</h5>
                </div>
                <div class="p-4">
                    <?php if(empty($recentActivities)): ?>
                        <div class="text-center py-4">
                            <p class="text-muted-custom italic">Aucune activité récente.</p>
                        </div>
                    <?php else: ?>
                        <div class="activity-timeline">
                            <?php foreach($recentActivities as $act): ?>
                                <div class="activity-item d-flex gap-3 mb-4">
                                    <div class="activity-icon bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                                        <?php if($act['action_type'] === 'project_update'): ?>
                                            <i class="fa-solid fa-rocket text-primary small"></i>
                                        <?php elseif($act['action_type'] === 'user_update'): ?>
                                            <i class="fa-solid fa-user-shield text-danger small"></i>
                                        <?php else: ?>
                                            <i class="fa-solid fa-bolt text-warning small"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="text-main small lh-sm"><?= htmlspecialchars($act['description']) ?></div>
                                        <div class="text-muted-custom" style="font-size: 0.75rem;">
                                            Par <span class="fw-bold"><?= htmlspecialchars($act['pseudo']) ?></span> • <?= date('H:i', strtotime($act['created_at'])) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <hr class="border-custom">
                    <p class="text-muted-custom small mb-0"><i class="fa-solid fa-shield-check me-1"></i>Toutes les actions sont auditées.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .backdrop-blur { backdrop-filter: blur(8px); }
    .activity-timeline { position: relative; }
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 1px;
        background: var(--border-color);
        z-index: 0;
    }
    .activity-item { position: relative; z-index: 1; }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
