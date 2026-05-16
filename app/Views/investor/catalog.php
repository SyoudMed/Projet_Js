<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1">
    <div class="row align-items-end mb-5">
        <div class="col-lg-5">
            <h2 class="fw-bold mb-1 h1">Explorer les opportunités</h2>
            <p class="text-muted-custom mb-0 fs-5">Investissez dans les startups de demain.</p>
        </div>
        <div class="col-lg-7 mt-4 mt-lg-0">
            <form method="GET" action="<?= URLROOT ?>/investor/catalog" class="row g-2 justify-content-lg-end">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-surface border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control bg-surface border-start-0 ps-0" placeholder="Rechercher..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="statut" class="form-select bg-surface border-custom">
                        <option value="">Tous</option>
                        <option value="actif" <?= ($statut === 'actif') ? 'selected' : '' ?>>Ouvert</option>
                        <option value="cloture" <?= ($statut === 'cloture') ? 'selected' : '' ?>>Terminé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select bg-surface border-custom">
                        <option value="date_desc" <?= ($sort === 'date_desc') ? 'selected' : '' ?>>Plus récents</option>
                        <option value="popularity" <?= ($sort === 'popularity') ? 'selected' : '' ?>>Popularité</option>
                        <option value="funding" <?= ($sort === 'funding') ? 'selected' : '' ?>>Progression</option>
                        <option value="price_asc" <?= ($sort === 'price_asc') ? 'selected' : '' ?>>Prix croissant</option>
                        <option value="price_desc" <?= ($sort === 'price_desc') ? 'selected' : '' ?>>Prix décroissant</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-sliders"></i></button>
                </div>
                <!-- Preserve secteur if set via chips -->
                <?php if(!empty($secteur)): ?>
                    <input type="hidden" name="secteur" value="<?= htmlspecialchars($secteur) ?>">
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Quick Sector Filters -->
    <div class="d-flex gap-2 mb-5 overflow-auto pb-2 scrollbar-hidden">
        <a href="<?= URLROOT ?>/investor/catalog?search=<?= urlencode($search) ?>&statut=<?= urlencode($statut) ?>&sort=<?= urlencode($sort) ?>" class="btn <?= empty($secteur) ? 'btn-primary' : 'btn-light border-custom text-muted-custom' ?> rounded-pill px-4">Tous</a>
        <?php 
        $secteurs = ['Technologie', 'Santé', 'Énergie', 'Agriculture', 'Finance', 'E-commerce'];
        foreach($secteurs as $s): 
            $isActive = ($secteur === $s);
        ?>
            <a href="<?= URLROOT ?>/investor/catalog?secteur=<?= urlencode($s) ?>&search=<?= urlencode($search) ?>&statut=<?= urlencode($statut) ?>&sort=<?= urlencode($sort) ?>" class="btn <?= $isActive ? 'btn-primary' : 'btn-light border-custom text-muted-custom' ?> rounded-pill px-4"><?= $s ?></a>
        <?php endforeach; ?>
    </div>

    <?php if(empty($projects)): ?>
        <div class="saas-card border-0 py-5 text-center">
            <h3 class="fw-bold">Aucun projet trouvé</h3>
            <p class="text-muted-custom mb-4">Essayez d'ajuster vos filtres.</p>
            <a href="<?= URLROOT ?>/investor/catalog" class="btn btn-primary px-5">Réinitialiser</a>
        </div>
    <?php else: ?>
        <div class="row g-4 mb-5">
            <?php foreach($projects as $p): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="saas-card h-100 border-0 overflow-hidden d-flex flex-column group">
                        <div class="position-relative overflow-hidden" style="height: 200px; background: linear-gradient(135deg, #4f46e5 0%, #818cf8 100%);">
                            <?php if($p['image_path']): ?>
                                <img src="<?= URLROOT . $p['image_path'] ?>" class="w-100 h-100 object-fit-cover opacity-75" alt="<?= htmlspecialchars($p['titre']) ?>">
                            <?php else: ?>
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white opacity-25">
                                    <i class="fa-solid fa-rocket fa-5x"></i>
                                </div>
                            <?php endif; ?>
                            <div class="position-absolute top-0 start-0 w-100 h-100 p-4 d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-start">
                                    <span class="badge bg-white bg-opacity-25 backdrop-blur text-white border border-white border-opacity-25 rounded-pill px-3 py-2 fw-bold">
                                        <?= htmlspecialchars($p['secteur']) ?>
                                    </span>
                                    <button class="btn btn-sm bg-white bg-opacity-25 backdrop-blur text-white border border-white border-opacity-25 rounded-circle p-0 toggle-favorite" data-project="<?= $p['id'] ?>" style="width: 36px; height: 36px; backdrop-filter: blur(8px);">
                                        <i class="<?= $p['is_favorite'] ? 'fa-solid text-warning' : 'fa-regular' ?> fa-star"></i>
                                    </button>
                                </div>
                                <?php if($p['statut'] === 'cloture'): ?>
                                    <div class="badge bg-success w-fit px-3 py-2 rounded-pill shadow-lg"><i class="fa-solid fa-check-circle me-2"></i>OBJECTIF ATTEINT</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <h4 class="fw-bold text-main mb-2"><?= htmlspecialchars($p['titre']) ?></h4>
                            <p class="text-muted-custom small mb-4 flex-grow-1 line-clamp-3"><?= htmlspecialchars($p['description']) ?></p>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2 small fw-bold">
                                    <span class="text-muted-custom">PROGRESSION</span>
                                    <span class="text-primary"><?= $p['percent_funded'] ?>%</span>
                                </div>
                                <div class="progress bg-light rounded-pill mb-3" style="height: 8px;">
                                    <div class="progress-bar bg-primary rounded-pill" role="progressbar" style="width: <?= $p['percent_funded'] ?>%"></div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-6"><div class="bg-light rounded-3 p-2 text-center small fw-bold"><?= number_format($p['investor_count']) ?> inv.</div></div>
                                    <div class="col-6"><div class="bg-light rounded-3 p-2 text-center small fw-bold"><?= number_format($p['prix_unitaire'], 2) ?> DT</div></div>
                                </div>
                            </div>
                            <a href="<?= URLROOT ?>/investor/project?id=<?= $p['id'] ?>" class="btn btn-primary w-100 py-3 fw-bold">Détails & Investir</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if($totalPages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center gap-2">
                    <?php 
                    $params = $_GET;
                    for($i = 1; $i <= $totalPages; $i++): 
                        $params['page'] = $i;
                        $queryStr = http_build_query($params);
                    ?>
                        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                            <a class="page-link border-custom rounded-3 px-4 py-2 <?= ($i === $page) ? 'bg-primary border-primary text-white' : 'bg-surface text-main' ?>" href="<?= URLROOT ?>/investor/catalog?<?= $queryStr ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</main>

<style>
    .backdrop-blur { backdrop-filter: blur(8px); }
    .w-fit { width: fit-content; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .scrollbar-hidden::-webkit-scrollbar { display: none; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteBtns = document.querySelectorAll('.toggle-favorite');
    
    favoriteBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const projectId = this.getAttribute('data-project');
            const icon = this.querySelector('i');

            fetch('<?= URLROOT ?>/investor/toggleFavorite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'project_id=' + projectId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    if (data.is_favorite) {
                        icon.classList.replace('fa-regular', 'fa-solid');
                        icon.classList.add('text-warning');
                    } else {
                        icon.classList.replace('fa-solid', 'fa-regular');
                        icon.classList.remove('text-warning');
                    }
                }
            });
        });
    });
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
