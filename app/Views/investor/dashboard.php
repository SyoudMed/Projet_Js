<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1 pb-5">
    <!-- Dashboard Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h2 class="fw-bold mb-1 h1">Mon Portefeuille</h2>
            <p class="text-muted-custom mb-0">Suivez la performance de vos investissements en temps réel.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= URLROOT ?>/investor/catalog" class="btn btn-primary px-4 py-2 shadow-sm rounded-3">
                <i class="fa-solid fa-plus me-2"></i>Nouvel Investissement
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-5 p-3" role="alert">
            <div class="d-flex align-items-center">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                    <i class="fa-solid fa-check small"></i>
                </div>
                <div>
                    <strong class="d-block">Investissement réussi !</strong>
                    <span class="small opacity-75">Votre participation a été enregistrée et votre certificat est disponible.</span>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Summary Statistics -->
    <div class="row g-4 mb-5">
        <div class="col-lg-4">
            <div class="saas-card border-0 p-4 position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-wallet fa-4x"></i>
                </div>
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3" style="letter-spacing: 0.05em;">Capital Déployé</h6>
                <h2 class="fw-bold mb-2 text-main"><?= number_format($totalInvested, 2) ?> <span class="fs-4 fw-medium opacity-50">DT</span></h2>
                <div class="d-flex align-items-center text-success small fw-bold">
                    <i class="fa-solid fa-arrow-trend-up me-1"></i> +12.5% <span class="text-muted-custom fw-normal ms-1 opacity-75">ce mois</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="saas-card border-0 p-4 position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-rocket fa-4x"></i>
                </div>
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3" style="letter-spacing: 0.05em;">Startups Soutenues</h6>
                <h2 class="fw-bold mb-2 text-main"><?= count($investments) ?></h2>
                <p class="text-muted-custom small mb-0 opacity-75">Diversification active du portfolio</p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="saas-card border-0 p-4 position-relative overflow-hidden">
                <div class="position-absolute top-0 end-0 p-3 opacity-10">
                    <i class="fa-solid fa-shield-heart fa-4x"></i>
                </div>
                <h6 class="text-muted-custom text-uppercase small fw-bold mb-3" style="letter-spacing: 0.05em;">Favoris Surveillés</h6>
                <h2 class="fw-bold mb-2 text-main"><?= count($favorites) ?></h2>
                <p class="text-muted-custom small mb-0 opacity-75">Opportunités en attente de financement</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="row g-4">
        <!-- Investment History -->
        <div class="col-lg-8">
            <div class="saas-card border-0 h-100">
                <div class="px-4 py-4 border-bottom border-custom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-main">Historique des participations</h5>
                </div>
                <div class="p-0">
                    <?php if(empty($investments)): ?>
                        <div class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                                <i class="fa-solid fa-receipt fs-4 text-muted-custom opacity-50"></i>
                            </div>
                            <p class="text-muted-custom mb-0">Vous n'avez pas encore investi dans un projet.</p>
                            <a href="<?= URLROOT ?>/investor/catalog" class="btn btn-link text-primary text-decoration-none small">Parcourir le catalogue</a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-saas table-borderless align-middle w-100 mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">PROJET</th>
                                        <th>DATE</th>
                                        <th>ACTIONS</th>
                                        <th>TOTAL</th>
                                        <th class="text-end pe-4">DOCUMENTS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($investments as $inv): ?>
                                    <tr class="hover-elevate">
                                        <td class="ps-4">
                                            <div class="fw-bold text-main"><?= htmlspecialchars($inv['titre']) ?></div>
                                            <div class="small text-muted-custom opacity-75"><?= htmlspecialchars($inv['secteur']) ?></div>
                                        </td>
                                        <td class="small text-muted-custom"><?= date('d M Y', strtotime($inv['date_investissement'])) ?></td>
                                        <td><span class="badge bg-light text-main border border-custom px-2 py-1"><?= number_format($inv['nb_actions']) ?> act.</span></td>
                                        <td class="fw-bold text-main"><?= number_format($inv['montant_total'], 2) ?> DT</td>
                                        <td class="text-end pe-4">
                                            <a href="<?= URLROOT ?>/investor/certificate?id=<?= $inv['id'] ?>" target="_blank" class="btn btn-sm btn-primary py-1 px-3 rounded-pill shadow-sm">
                                                <i class="fa-solid fa-file-contract me-1"></i> Certificat
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Favorites & Watchlist -->
        <div class="col-lg-4">
            <div class="saas-card border-0 h-100">
                <div class="px-4 py-4 border-bottom border-custom">
                    <h5 class="fw-bold mb-0 text-main">Favoris</h5>
                </div>
                <div class="p-0">
                    <?php if(empty($favorites)): ?>
                        <div class="text-center py-5">
                            <i class="fa-regular fa-star fa-3x text-muted-custom opacity-25 mb-3"></i>
                            <p class="text-muted-custom small px-5">Ajoutez des projets en favoris pour les suivre ici.</p>
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach($favorites as $fav): ?>
                            <div class="list-group-item bg-surface border-custom px-4 py-3 d-flex justify-content-between align-items-center hover-elevate">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><a href="<?= URLROOT ?>/investor/project?id=<?= $fav['id'] ?>" class="text-decoration-none text-main fw-bold"><?= htmlspecialchars($fav['titre']) ?></a></h6>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="small text-muted-custom opacity-75"><?= htmlspecialchars($fav['secteur']) ?></span>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-0" style="font-size: 0.6rem;"><?= ucfirst($fav['statut']) ?></span>
                                    </div>
                                </div>
                                <form method="POST" action="<?= URLROOT ?>/investor/toggleFavorite">
                                    <input type="hidden" name="project_id" value="<?= $fav['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-link text-warning p-0"><i class="fa-solid fa-star"></i></button>
                                </form>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
