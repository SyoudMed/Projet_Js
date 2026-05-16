<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom border-custom">
        <div>
            <h2 class="fw-bold mb-1">Paramètres du Profil</h2>
            <p class="text-muted-custom mb-0">Gérez vos informations personnelles et votre sécurité.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3">
            <div class="saas-card border-0 p-3">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist">
                    <button class="nav-link active text-start py-3 px-4 mb-2 fw-medium" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">
                        <i class="fa-solid fa-user-gear me-2"></i>Informations
                    </button>
                    <button class="nav-link text-start py-3 px-4 fw-medium" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab">
                        <i class="fa-solid fa-shield-halved me-2"></i>Sécurité
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="tab-content" id="v-pills-tabContent">
                
                <!-- Profile Info Tab -->
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel">
                    <div class="saas-card border-0 p-4 p-md-5">
                        <h4 class="fw-bold mb-4">Informations Générales</h4>
                        
                        <?php if(isset($_GET['success'])): ?>
                            <div class="alert alert-success border-0 rounded-3 mb-4">
                                <i class="fa-solid fa-circle-check me-2"></i>Profil mis à jour avec succès.
                            </div>
                        <?php endif; ?>

                        <form action="<?= URLROOT ?>/auth/updateProfile" method="POST">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted-custom small fw-bold text-uppercase">Prénom</label>
                                    <input type="text" name="prenom" class="form-control bg-bg-color border-custom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted-custom small fw-bold text-uppercase">Nom</label>
                                    <input type="text" name="nom" class="form-control bg-bg-color border-custom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted-custom small fw-bold text-uppercase">Pseudo</label>
                                    <input type="text" name="pseudo" class="form-control bg-bg-color border-custom" value="<?= htmlspecialchars($user['pseudo']) ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted-custom small fw-bold text-uppercase">Email</label>
                                    <input type="email" name="email" class="form-control bg-bg-color border-custom" value="<?= htmlspecialchars($user['email']) ?>" required>
                                </div>
                            </div>

                            <hr class="my-5 border-custom">

                            <h4 class="fw-bold mb-4">Informations Professionnelles</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted-custom small fw-bold text-uppercase">Nom de l'entreprise</label>
                                    <input type="text" name="nom_entreprise" class="form-control bg-bg-color border-custom" value="<?= htmlspecialchars($user['nom_entreprise'] ?? '') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted-custom small fw-bold text-uppercase">Adresse</label>
                                    <input type="text" name="adresse_entreprise" class="form-control bg-bg-color border-custom" value="<?= htmlspecialchars($user['adresse_entreprise'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-5 py-2 fw-medium shadow-sm hover-elevate">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                    <div class="saas-card border-0 p-4 p-md-5">
                        <h4 class="fw-bold mb-4">Changer le mot de passe</h4>
                        
                        <?php if(isset($_GET['success_pw'])): ?>
                            <div class="alert alert-success border-0 rounded-3 mb-4">
                                <i class="fa-solid fa-circle-check me-2"></i>Mot de passe modifié avec succès.
                            </div>
                        <?php elseif(isset($_GET['error_pw'])): ?>
                            <div class="alert alert-danger border-0 rounded-3 mb-4">
                                <i class="fa-solid fa-triangle-exclamation me-2"></i>L'ancien mot de passe est incorrect.
                            </div>
                        <?php endif; ?>

                        <form action="<?= URLROOT ?>/auth/changePassword" method="POST">
                            <div class="mb-4">
                                <label class="form-label text-muted-custom small fw-bold text-uppercase">Mot de passe actuel</label>
                                <input type="password" name="current_password" class="form-control bg-bg-color border-custom" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted-custom small fw-bold text-uppercase">Nouveau mot de passe</label>
                                <input type="password" name="new_password" class="form-control bg-bg-color border-custom" required minlength="6">
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted-custom small fw-bold text-uppercase">Confirmer le nouveau mot de passe</label>
                                <input type="password" name="confirm_password" class="form-control bg-bg-color border-custom" required minlength="6">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-5 py-2 fw-medium shadow-sm hover-elevate">Mettre à jour le mot de passe</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
