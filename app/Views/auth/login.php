<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5 position-relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="z-index: -1;">
        <div class="position-absolute top-0 start-0 bg-primary opacity-10 rounded-circle blur-3xl" style="width: 500px; height: 500px; filter: blur(150px); transform: translate(-30%, -30%);"></div>
        <div class="position-absolute bottom-0 end-0 bg-info opacity-10 rounded-circle blur-3xl" style="width: 500px; height: 500px; filter: blur(150px); transform: translate(30%, 30%);"></div>
    </div>

    <div class="container px-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="saas-card border-0 shadow-lg p-4 p-md-5">
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-bolt fs-2"></i>
                        </div>
                        <h2 class="fw-bold h3">Bon retour !</h2>
                        <p class="text-muted-custom">Connectez-vous pour accéder à votre espace.</p>
                    </div>
                    
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger border-0 rounded-3 small mb-4">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= URLROOT ?>/auth/login">
                        <div class="mb-4">
                            <label class="form-label text-muted-custom small text-uppercase fw-bold">Pseudo ou Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-main border-custom border-end-0 text-muted-custom"><i class="fa-regular fa-user"></i></span>
                                <input type="text" name="pseudo" class="form-control bg-main border-custom border-start-0 ps-0" placeholder="votre_pseudo" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold mb-0">Mot de passe</label>
                                <a href="#" class="text-primary small text-decoration-none">Oublié ?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-main border-custom border-end-0 text-muted-custom"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control bg-main border-custom border-start-0 ps-0" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label small text-muted-custom" for="rememberMe">Rester connecté</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-sm mb-4">Se connecter</button>
                        
                        <div class="text-center">
                            <p class="text-muted-custom small mb-0">Pas encore de compte ? <a href="<?= URLROOT ?>/auth/registerInvestor" class="text-primary text-decoration-none fw-bold">S'inscrire gratuitement</a></p>
                        </div>
                    </form>
                </div>
                
                <p class="text-center mt-5 text-muted-custom small">&copy; <?= date('Y') ?> StartuPInvest. Connexion Sécurisée SSL.</p>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
