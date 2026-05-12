<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Portefeuille Investisseur</h2>
            <p class="text-muted-custom mb-0">Bienvenue, suivez vos investissements et projets favoris.</p>
        </div>
        <a href="<?= URLROOT ?>/investor/catalog" class="btn btn-primary shadow-sm hover-elevate px-4">
            <i class="fa-solid fa-compass me-2"></i>Explorer les projets
        </a>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>Félicitations ! Votre investissement a été enregistré avec succès.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row mb-5 g-4">
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-wallet fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Total Investi</h6>
                        <h2 class="fw-bold mb-0 text-main"><?= number_format($totalInvested, 2) ?> DT</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-chart-pie fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Participations actives</h6>
                        <h2 class="fw-bold mb-0 text-main"><?= count($investments) ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="saas-card border-0">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 56px; height: 56px;">
                        <i class="fa-solid fa-star fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted-custom text-uppercase small fw-semibold mb-1">Projets favoris</h6>
                        <h2 class="fw-bold mb-0 text-main"><?= count($favorites) ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="saas-card border-0 h-100 overflow-hidden">
                <div class="bg-surface px-4 py-3 border-bottom border-custom d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">Historique des investissements</h5>
                </div>
                <div class="p-0">
                    <?php if(empty($investments)): ?>
                        <div class="text-center py-5">
                            <p class="text-muted-custom mb-0">Aucun investissement pour le moment.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-saas table-borderless align-middle w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Projet</th>
                                        <th>Actions</th>
                                        <th>Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($investments as $inv): ?>
                                    <tr>
                                        <td class="text-muted-custom"><?= date('d/m/Y', strtotime($inv['date_investissement'])) ?></td>
                                        <td class="fw-medium text-main"><a href="/js_project/public/investor/project?id=<?= $inv['project_id'] ?>" class="text-decoration-none"><?= htmlspecialchars($inv['titre']) ?></a></td>
                                        <td><?= htmlspecialchars($inv['nb_actions']) ?></td>
                                        <td class="fw-bold text-success">+<?= number_format($inv['montant_total'], 2) ?> DT</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="saas-card border-0 h-100 overflow-hidden">
                <div class="bg-surface px-4 py-3 border-bottom border-custom d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">Favoris</h5>
                </div>
                <div class="p-0">
                    <?php if(empty($favorites)): ?>
                        <div class="text-center py-5">
                            <p class="text-muted-custom mb-0">Aucun projet favori.</p>
                        </div>
                    <?php else: ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach($favorites as $fav): ?>
                            <li class="list-group-item bg-surface border-custom px-4 py-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1"><a href="/js_project/public/investor/project?id=<?= $fav['id'] ?>" class="text-decoration-none text-main fw-medium"><?= htmlspecialchars($fav['titre']) ?></a></h6>
                                    <small class="text-muted-custom"><?= htmlspecialchars($fav['secteur']) ?></small>
                                </div>
                                <form method="POST" action="/js_project/public/investor/toggleFavorite">
                                    <input type="hidden" name="project_id" value="<?= $fav['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-link text-warning p-0"><i class="fa-solid fa-star fs-5"></i></button>
                                </form>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
