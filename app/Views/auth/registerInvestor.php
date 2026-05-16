<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5 position-relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="z-index: -1;">
        <div class="position-absolute top-0 end-0 bg-success opacity-10 rounded-circle" style="width: 500px; height: 500px; filter: blur(150px); transform: translate(30%, -30%);"></div>
        <div class="position-absolute bottom-0 start-0 bg-primary opacity-10 rounded-circle" style="width: 500px; height: 500px; filter: blur(150px); transform: translate(-30%, 30%);"></div>
    </div>

    <div class="container px-4">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="saas-card border-0 shadow-lg p-4 p-md-5">
                    <div class="text-center mb-5">
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3 fw-bold border border-success border-opacity-25" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                            ESPACE INVESTISSEUR
                        </span>
                        <h2 class="fw-bold h1">Rejoindre StartuPInvest</h2>
                        <p class="text-muted-custom">Créez votre compte en quelques secondes pour accéder aux opportunités.</p>
                    </div>
                    
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger border-0 rounded-3 small mb-4">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= URLROOT ?>/auth/registerInvestor" id="registerForm">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Nom</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-main border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-signature"></i></span>
                                    <input type="text" name="nom" class="form-control bg-main border-custom border-start-0 ps-0" placeholder="Nom" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Prénom</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-main border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-signature"></i></span>
                                    <input type="text" name="prenom" class="form-control bg-main border-custom border-start-0 ps-0" placeholder="Prénom" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Email professionnel</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-main border-custom border-end-0 text-muted-custom"><i class="fa-regular fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control bg-main border-custom border-start-0 ps-0" placeholder="nom@exemple.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">CIN</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-main border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" name="cin" class="form-control bg-main border-custom border-start-0 ps-0" pattern="\d{8}" placeholder="8 chiffres" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Pseudo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-bg-color border-custom border-end-0 text-muted-custom"><i class="fa-regular fa-at"></i></span>
                                    <input type="text" name="pseudo" class="form-control bg-bg-color border-custom border-start-0 ps-0" placeholder="pseudo_unique" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-bg-color border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-key"></i></span>
                                    <input type="password" name="password" class="form-control bg-bg-color border-custom border-start-0 ps-0" placeholder="••••••••" minlength="6" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mt-5 mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label small text-muted-custom" for="terms">
                                J'accepte les <a href="#" class="text-primary text-decoration-none">Conditions Générales d'Utilisation</a> et la <a href="#" class="text-primary text-decoration-none">Politique de Confidentialité</a>.
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-sm mb-4">Créer mon compte Investisseur</button>
                        
                        <div class="text-center">
                            <p class="text-muted-custom small mb-0">Vous avez déjà un compte ? <a href="<?= URLROOT ?>/auth/login" class="text-primary text-decoration-none fw-bold">Se connecter</a></p>
                        </div>
                    </form>
                </div>
                
                <div class="d-flex justify-content-center gap-4 mt-5 text-muted-custom small">
                    <span><i class="fa-solid fa-shield-halved me-2"></i>Sécurité 256-bit</span>
                    <span><i class="fa-solid fa-user-lock me-2"></i>Protection des données</span>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
