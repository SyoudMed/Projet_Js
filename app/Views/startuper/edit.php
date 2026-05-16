<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
                <div>
                    <h2 class="fw-bold mb-1">Modifier le Projet</h2>
                    <p class="text-muted-custom mb-0">Mettez à jour les informations de votre startup.</p>
                </div>
                <a href="<?= URLROOT ?>/startuper/dashboard" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                    Annuler
                </a>
            </div>

            <div class="saas-card border-0 p-4 p-md-5 shadow-lg">
                <form action="<?= URLROOT ?>/startuper/update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $project['id'] ?>">

                    <div class="mb-4">
                        <label class="form-label text-muted-custom small text-uppercase fw-bold">Titre du Projet</label>
                        <input type="text" name="titre" class="form-control bg-bg-color border-custom" value="<?= htmlspecialchars($project['titre']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted-custom small text-uppercase fw-bold">Description</label>
                        <textarea name="description" class="form-control bg-bg-color border-custom" rows="6" required><?= htmlspecialchars($project['description']) ?></textarea>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-bold">Secteur d'activité</label>
                            <select name="secteur" class="form-select bg-bg-color border-custom" required>
                                <?php 
                                $secteurs = ['Technologie', 'Santé', 'Énergie', 'Agriculture', 'Finance', 'E-commerce', 'Autre'];
                                foreach($secteurs as $s): ?>
                                    <option value="<?= $s ?>" <?= $project['secteur'] === $s ? 'selected' : '' ?>><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-bold">Date limite de financement</label>
                            <input type="date" name="date_limite" class="form-control bg-bg-color border-custom" value="<?= $project['date_limite'] ?>" required>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-bold">Nombre d'actions totales</label>
                            <input type="number" name="nb_actions" class="form-control bg-bg-color border-custom" value="<?= $project['nb_actions'] ?>" required min="1">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-bold">Prix d'une action (DT)</label>
                            <input type="number" name="prix_unitaire" class="form-control bg-bg-color border-custom" value="<?= $project['prix_unitaire'] ?>" step="0.01" required min="0.1">
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-bold">Business Plan (PDF)</label>
                            <input type="file" name="business_plan" class="form-control bg-bg-color border-custom" accept=".pdf">
                            <?php if($project['business_plan_path']): ?>
                                <small class="text-success"><i class="fa-solid fa-check-circle me-1"></i> Fichier actuel présent</small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted-custom small text-uppercase fw-bold">Image de couverture</label>
                            <input type="file" name="image" class="form-control bg-bg-color border-custom" accept="image/*">
                            <?php if($project['image_path']): ?>
                                <small class="text-success"><i class="fa-solid fa-check-circle me-1"></i> Image actuelle présente</small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 rounded-3 mb-5 small">
                        <i class="fa-solid fa-circle-info me-2"></i><strong>Note :</strong> Les modifications sont définitives. Assurez-vous que les informations financières sont exactes.
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-3 fw-bold rounded-3 shadow-sm">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
