<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1">
    <div class="mb-4">
        <a href="/js_project/public/investor/catalog" class="btn btn-sm btn-light border-custom"><i class="fa-solid fa-arrow-left me-2"></i>Retour au catalogue</a>
    </div>

    <div class="row g-4">
        <!-- Project Details Column -->
        <div class="col-lg-8">
            <div class="saas-card border-0 overflow-hidden mb-4">
                <?php if($project['image_path']): ?>
                    <img src="/js_project/public<?= htmlspecialchars($project['image_path']) ?>" class="w-100 object-fit-cover border-bottom border-custom" style="height: 300px;" alt="Project Image">
                <?php else: ?>
                    <div class="w-100 bg-bg-color border-bottom border-custom d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="fa-solid fa-image fa-4x text-muted-custom opacity-25"></i>
                    </div>
                <?php endif; ?>
                
                <div class="p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium border border-primary border-opacity-25"><?= htmlspecialchars($project['secteur']) ?></span>
                        <form method="POST" action="/js_project/public/investor/toggleFavorite">
                            <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                            <button type="submit" class="btn btn-outline-warning btn-sm hover-elevate"><i class="fa-regular fa-star me-2"></i>Ajouter aux favoris</button>
                        </form>
                    </div>

                    <h1 class="fw-bold text-main mb-3"><?= htmlspecialchars($project['titre']) ?></h1>
                    
                    <div class="d-flex align-items-center mb-5 text-muted-custom">
                        <i class="fa-solid fa-building me-2"></i><span class="me-4 fw-medium"><?= htmlspecialchars($project['nom_entreprise']) ?></span>
                        <i class="fa-solid fa-user me-2"></i><span class="me-4 fw-medium"><?= htmlspecialchars($project['prenom'] . ' ' . $project['nom']) ?></span>
                        <i class="fa-regular fa-clock me-2"></i><span>Limite: <?= date('d/m/Y', strtotime($project['date_limite'])) ?></span>
                    </div>

                    <h5 class="fw-semibold mb-3 border-bottom border-custom pb-2">Description du projet</h5>
                    <div class="text-muted-custom lh-lg mb-5" style="white-space: pre-wrap;"><?= htmlspecialchars($project['description']) ?></div>

                    <h5 class="fw-semibold mb-3 border-bottom border-custom pb-2">Documents</h5>
                    <?php if($project['business_plan_path']): ?>
                        <a href="/js_project/public<?= htmlspecialchars($project['business_plan_path']) ?>" target="_blank" class="btn btn-light border-custom hover-elevate text-main">
                            <i class="fa-regular fa-file-pdf text-danger me-2"></i>Télécharger le Business Plan
                        </a>
                    <?php else: ?>
                        <p class="text-muted-custom">Aucun document joint.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Investment Panel Column -->
        <div class="col-lg-4">
            <div class="saas-card border-0 p-4 sticky-top" style="top: 100px;">
                <h4 class="fw-bold mb-4 border-bottom border-custom pb-3">Investir</h4>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted-custom">Prix par action</span>
                        <span class="fw-bold text-main fs-5"><?= number_format($project['prix_unitaire'], 2) ?> DT</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted-custom">Actions disponibles</span>
                        <span class="fw-medium text-main"><?= number_format($project['nb_actions']) ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted-custom">Objectif total</span>
                        <span class="fw-bold text-success"><?= number_format($project['nb_actions'] * $project['prix_unitaire'], 2) ?> DT</span>
                    </div>
                </div>

                <form method="POST" action="/js_project/public/investor/invest" id="investForm">
                    <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                    <input type="hidden" id="prixUnitaire" value="<?= $project['prix_unitaire'] ?>">
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nombre d'actions à acheter</label>
                        <input type="number" name="nb_actions" id="nbActionsInput" class="form-control form-control-lg bg-surface" min="1" max="<?= $project['nb_actions'] ?>" value="1" required>
                    </div>

                    <div class="bg-primary bg-opacity-10 rounded-3 p-3 mb-4 border border-primary border-opacity-25">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-medium">Total à payer</span>
                            <span class="text-primary fw-bold fs-4" id="totalPriceCalc"><?= number_format($project['prix_unitaire'], 2) ?> DT</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 hover-elevate">Confirmer l'investissement</button>
                    <p class="text-muted-custom text-center mt-3 small mb-0"><i class="fa-solid fa-shield-halved me-1"></i>Paiement sécurisé et garanti</p>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('nbActionsInput');
    const priceDisplay = document.getElementById('totalPriceCalc');
    const unitPrice = parseFloat(document.getElementById('prixUnitaire').value);

    input.addEventListener('input', function() {
        const quantity = parseInt(this.value) || 0;
        const total = quantity * unitPrice;
        
        // Format as number with 2 decimals
        priceDisplay.textContent = new Intl.NumberFormat('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(total) + ' DT';
    });
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
