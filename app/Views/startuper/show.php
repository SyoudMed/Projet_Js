<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1 pb-5">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item small"><a href="<?= URLROOT ?>/startuper/dashboard" class="text-decoration-none">Tableau de bord</a></li>
                    <li class="breadcrumb-item active small" aria-current="page">Aperçu du projet</li>
                </ol>
            </nav>
            <h2 class="fw-bold mb-1">Détails du Projet</h2>
            <p class="text-muted-custom mb-0">Consultez les performances et les retours de votre projet.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= URLROOT ?>/startuper/edit?id=<?= $project['id'] ?>" class="btn btn-outline-primary px-4 py-2 rounded-3">
                <i class="fa-solid fa-pen me-2"></i>Modifier
            </a>
            <button onclick="confirmAbandon(<?= $project['id'] ?>)" class="btn btn-outline-danger px-4 py-2 rounded-3">
                <i class="fa-solid fa-ban me-2"></i>Abandonner
            </button>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="saas-card border-0 mb-4 overflow-hidden">
                <div class="position-relative" style="height: 300px;">
                    <?php if($project['image_path']): ?>
                        <img src="<?= URLROOT . $project['image_path'] ?>" class="w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($project['titre']) ?>">
                    <?php else: ?>
                        <div class="w-100 h-100 bg-primary d-flex align-items-center justify-content-center text-white opacity-25">
                            <i class="fa-solid fa-rocket fa-6x"></i>
                        </div>
                    <?php endif; ?>
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge bg-white text-main shadow-sm border border-custom px-3 py-2 rounded-pill fw-bold">
                            <?= htmlspecialchars($project['secteur']) ?>
                        </span>
                    </div>
                </div>
                <div class="p-4 p-md-5">
                    <h3 class="fw-bold mb-3"><?= htmlspecialchars($project['titre']) ?></h3>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="text-warning">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <i class="fa-<?= $i <= $avgRating ? 'solid' : 'regular' ?> fa-star"></i>
                            <?php endfor; ?>
                            <span class="text-main fw-bold ms-2"><?= $avgRating ?>/5</span>
                            <span class="text-muted-custom small">(<?= count($reviews) ?> avis)</span>
                        </div>
                    </div>
                    <p class="text-main fs-5 lh-base"><?= nl2br(htmlspecialchars($project['description'])) ?></p>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="saas-card border-0 p-4 p-md-5">
                <h4 class="fw-bold mb-4">Retours des investisseurs</h4>
                <?php if(empty($reviews)): ?>
                    <p class="text-muted-custom">Aucun avis n'a encore été laissé sur ce projet.</p>
                <?php else: ?>
                    <?php foreach($reviews as $review): ?>
                        <div class="border-bottom border-custom pb-4 mb-4 last-child-border-0">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="fw-bold mb-0 text-main"><?= htmlspecialchars($review['prenom'] . ' ' . $review['nom']) ?></h6>
                                    <small class="text-muted-custom"><?= date('d/m/Y', strtotime($review['created_at'])) ?></small>
                                </div>
                                <div class="text-warning small">
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <i class="fa-<?= $i <= $review['note'] ? 'solid' : 'regular' ?> fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="mb-0 text-main small opacity-75"><?= nl2br(htmlspecialchars($review['commentaire'])) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar Stats -->
        <div class="col-lg-4">
            <div class="saas-card border-0 p-4 mb-4 bg-primary bg-opacity-10 border-primary border-opacity-10 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4">État de la levée</h5>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2 small fw-bold">
                        <span class="text-muted-custom">PROGRESSION</span>
                        <span class="text-primary"><?= round(($totalSold / $project['nb_actions']) * 100) ?>%</span>
                    </div>
                    <div class="progress bg-white rounded-pill mb-3" style="height: 10px;">
                        <div class="progress-bar bg-primary rounded-pill progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= round(($totalSold / $project['nb_actions']) * 100) ?>%"></div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="bg-white rounded-3 p-3 border border-custom">
                            <div class="small text-muted-custom mb-1" style="font-size: 0.7rem;">COLLECTÉ</div>
                            <div class="fw-bold text-main"><?= number_format($totalSold * $project['prix_unitaire'], 2) ?> DT</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-white rounded-3 p-3 border border-custom">
                            <div class="small text-muted-custom mb-1" style="font-size: 0.7rem;">OBJECTIF</div>
                            <div class="fw-bold text-main"><?= number_format($project['nb_actions'] * $project['prix_unitaire'], 2) ?> DT</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="bg-white rounded-3 p-3 border border-custom text-center">
                            <div class="small text-muted-custom mb-1" style="font-size: 0.7rem;">INVESTISSEURS</div>
                            <div class="fw-bold text-main"><?= count($investors) ?> participants</div>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <a href="<?= URLROOT ?>/startuper/investors?project_id=<?= $project['id'] ?>" class="btn btn-primary py-3 fw-bold rounded-3">
                        <i class="fa-solid fa-users me-2"></i>Liste des Actionnaires
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function confirmAbandon(id) {
    if(confirm('Êtes-vous sûr de vouloir abandonner ce projet ? Cette action est irréversible.')) {
        window.location.href = '<?= URLROOT ?>/startuper/abandon?id=' + id;
    }
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
