<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <a href="/js_project/public/startuper/dashboard" class="btn btn-sm btn-light border-custom me-3"><i class="fa-solid fa-arrow-left"></i></a>
                <h3 class="fw-bold m-0">Créer un nouveau projet</h3>
            </div>

            <div class="saas-card border-0 p-4 p-md-5">
                <?php if(!empty($error)): ?>
                    <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="/js_project/public/startuper/create" enctype="multipart/form-data">
                    <h5 class="fw-semibold mb-4 pb-2 border-bottom border-custom">Présentation</h5>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted-custom small text-uppercase fw-semibold">Titre du projet</label>
                        <input type="text" name="titre" class="form-control form-control-lg bg-surface" placeholder="Nom de votre startup ou produit" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted-custom small text-uppercase fw-semibold">Description détaillée</label>
                        <textarea name="description" class="form-control bg-surface" rows="6" placeholder="Expliquez votre vision, le problème que vous résolvez et votre solution..." required></textarea>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-semibold">Secteur d'activité</label>
                            <select name="secteur" class="form-select bg-surface" required>
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
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-semibold">Date limite de la levée</label>
                            <input type="date" name="date_limite" class="form-control bg-surface" required>
                        </div>
                    </div>

                    <h5 class="fw-semibold mb-4 pb-2 border-bottom border-custom">Données Financières</h5>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-semibold">Nombre d'actions proposées</label>
                            <input type="number" name="nb_actions" class="form-control bg-surface" min="1" placeholder="Ex: 1000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-semibold">Prix unitaire (DT)</label>
                            <input type="number" name="prix_unitaire" class="form-control bg-surface" step="0.01" min="0.1" placeholder="Ex: 50.00" required>
                        </div>
                    </div>

                    <h5 class="fw-semibold mb-4 pb-2 border-bottom border-custom">Documents</h5>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted-custom small text-uppercase fw-semibold">Business Plan</label>
                        <input type="file" name="business_plan" class="form-control bg-surface" accept="application/pdf">
                        <div class="form-text mt-2"><i class="fa-solid fa-circle-info me-1"></i>Format PDF uniquement. Requis pour la validation par l'administration.</div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label text-muted-custom small text-uppercase fw-semibold">Image d'illustration</label>
                        <input type="file" name="image" class="form-control bg-surface" accept="image/jpeg, image/png">
                        <div class="form-text mt-2"><i class="fa-solid fa-image me-1"></i>Formats acceptés : JPEG, PNG (Max 5 Mo).</div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top border-custom">
                        <a href="/js_project/public/startuper/dashboard" class="btn btn-light border-custom px-4">Annuler</a>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm hover-elevate">Publier le projet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
