<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="flex-grow-1 d-flex align-items-center justify-content-center py-5 position-relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="z-index: -1;">
        <div class="position-absolute top-0 start-0 bg-primary opacity-10 rounded-circle" style="width: 500px; height: 500px; filter: blur(150px); transform: translate(-30%, -30%);"></div>
        <div class="position-absolute bottom-0 end-0 bg-indigo opacity-10 rounded-circle" style="width: 500px; height: 500px; filter: blur(150px); transform: translate(30%, 30%);"></div>
    </div>

    <div class="container px-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="saas-card border-0 shadow-lg p-4 p-md-5">
                    <div class="text-center mb-5">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3 fw-bold border border-primary border-opacity-25" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                            ESPACE STARTUPER
                        </span>
                        <h2 class="fw-bold h1">Propulsez votre projet</h2>
                        <p class="text-muted-custom">Rejoignez l'écosystème StartuPInvest et accédez au capital dont vous avez besoin.</p>
                    </div>
                    
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger border-0 rounded-3 small mb-4">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= URLROOT ?>/auth/registerStartuper" id="registerForm">
                        <div class="row g-4 mb-5">
                            <div class="col-12"><h5 class="fw-bold text-main mb-0"><i class="fa-solid fa-user-circle me-2 text-primary"></i>Informations Personnelles</h5></div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Nom</label>
                                <input type="text" name="nom" class="form-control bg-main border-custom" placeholder="Nom" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Prénom</label>
                                <input type="text" name="prenom" class="form-control bg-main border-custom" placeholder="Prénom" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Email</label>
                                <input type="email" name="email" class="form-control bg-main border-custom" placeholder="nom@startup.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">CIN</label>
                                <input type="text" name="cin" class="form-control bg-main border-custom" pattern="\d{8}" placeholder="8 chiffres" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Pseudo</label>
                                <input type="text" name="pseudo" class="form-control bg-main border-custom" placeholder="pseudo_fondateur" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Mot de passe</label>
                                <input type="password" name="password" class="form-control bg-main border-custom" placeholder="••••••••" minlength="6" required>
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-12"><h5 class="fw-bold text-main mb-0"><i class="fa-solid fa-building me-2 text-primary"></i>Informations Entreprise</h5></div>
                            <div class="col-md-12">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Nom de la Startup</label>
                                <input type="text" name="nom_entreprise" class="form-control bg-bg-color border-custom" placeholder="Ma Super Startup SARL" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Adresse du siège</label>
                                <textarea name="adresse_entreprise" class="form-control bg-bg-color border-custom" rows="2" placeholder="Adresse complète..." required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted-custom small text-uppercase fw-bold">Matricule Fiscale / Registre de commerce</label>
                                <input type="text" name="registre_commerce" class="form-control bg-bg-color border-custom" placeholder="Ex: 1234567/A/M/000" required>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label small text-muted-custom" for="terms">
                                En m'inscrivant, je confirme que ma startup est légalement constituée et j'accepte les <a href="#" class="text-primary text-decoration-none fw-bold">CGU</a>.
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 py-3 shadow-lg mb-4">Lancer mon compte Créateur</button>
                        
                        <div class="text-center">
                            <p class="text-muted-custom small mb-0">Déjà membre ? <a href="<?= URLROOT ?>/auth/login" class="text-primary text-decoration-none fw-bold">Se connecter</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
