<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 pb-3 border-bottom border-custom">
        <div class="mb-3 mb-md-0">
            <h2 class="fw-bold mb-1">Explorer les projets</h2>
            <p class="text-muted-custom mb-0">Découvrez et investissez dans les startups de demain.</p>
        </div>
        
        <form method="GET" action="/js_project/public/investor/catalog" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-surface border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" name="search" class="form-control bg-surface border-start-0 ps-0" placeholder="Rechercher..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <select name="secteur" class="form-select bg-surface border-custom" style="width: 150px;">
                <option value="">Tous les secteurs</option>
                <?php 
                $secteurs = ['Technologie', 'Santé', 'Énergie', 'Agriculture', 'Finance', 'E-commerce', 'Autre'];
                foreach($secteurs as $s) {
                    $selected = (isset($_GET['secteur']) && $_GET['secteur'] === $s) ? 'selected' : '';
                    echo "<option value=\"$s\" $selected>$s</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>
    </div>

    <?php if(empty($projects)): ?>
        <div class="text-center py-5">
            <div class="d-inline-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-muted rounded-circle mb-3" style="width: 80px; height: 80px;">
                <i class="fa-solid fa-magnifying-glass fs-2"></i>
            </div>
            <p class="fs-5 text-muted-custom">Aucun projet ne correspond à votre recherche.</p>
            <a href="/js_project/public/investor/catalog" class="btn btn-outline-secondary mt-2">Réinitialiser les filtres</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach($projects as $p): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="saas-card h-100 border-0 overflow-hidden d-flex flex-column">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 border border-primary border-opacity-25"><?= htmlspecialchars($p['secteur']) ?></span>
                                <form method="POST" action="/js_project/public/investor/toggleFavorite">
                                    <input type="hidden" name="project_id" value="<?= $p['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-link text-muted-custom p-0 hover-elevate"><i class="fa-regular fa-star fs-5"></i></button>
                                </form>
                            </div>
                            
                            <h5 class="fw-bold text-main mb-2"><?= htmlspecialchars($p['titre']) ?></h5>
                            <p class="text-muted-custom small mb-4 flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                <?= htmlspecialchars($p['description']) ?>
                            </p>
                            
                            <div class="bg-bg-color rounded-3 p-3 mb-4 border border-custom">
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted-custom">Actions totales</span>
                                    <span class="fw-semibold text-main"><?= number_format($p['nb_actions']) ?></span>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span class="text-muted-custom">Prix unitaire</span>
                                    <span class="fw-bold text-success"><?= number_format($p['prix_unitaire'], 2) ?> DT</span>
                                </div>
                            </div>
                            
                            <a href="/js_project/public/investor/project?id=<?= $p['id'] ?>" class="btn btn-outline-primary w-100 fw-medium">Voir les détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
