<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm glass-panel border-0">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="text-primary m-0">Créer un nouveau projet</h2>
                        <a href="/js_project/public/startuper/dashboard" class="btn btn-outline-secondary btn-sm">Retour</a>
                    </div>
                    
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="/js_project/public/startuper/create" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Titre du projet</label>
                            <input type="text" name="titre" class="form-control form-control-lg" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Description détaillée</label>
                            <textarea name="description" class="form-control" rows="5" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Secteur d'activité</label>
                                <select name="secteur" class="form-select" required>
                                    <option value="">Choisir un secteur...</option>
                                    <option value="Technologie">Technologie</option>
                                    <option value="Santé">Santé</option>
                                    <option value="Énergie">Énergie</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Finance">Finance</option>
                                    <option value="E-commerce">E-commerce</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Date limite de la levée</label>
                                <input type="date" name="date_limite" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Nombre d'actions proposées</label>
                                <input type="number" name="nb_actions" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">Prix unitaire de l'action (DT)</label>
                                <input type="number" name="prix_unitaire" class="form-control" step="0.01" min="0.1" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Business Plan (PDF uniquement)</label>
                            <input type="file" name="business_plan" class="form-control" accept="application/pdf">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Image d'illustration du produit/service</label>
                            <input type="file" name="image" class="form-control" accept="image/jpeg, image/png">
                            <div class="form-text">Formats acceptés : JPEG, PNG. Max 5 Mo.</div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 hover-elevate shadow mt-3">Publier le projet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
