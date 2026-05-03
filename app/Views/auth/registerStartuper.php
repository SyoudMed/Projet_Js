<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="saas-card w-100 p-4 p-md-5" style="max-width: 700px;">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill mb-2 fw-medium border border-primary border-opacity-25">Créateur</span>
            <h2 class="fw-bold">Rejoindre StartuPInvest</h2>
            <p class="text-muted-custom">Créez votre compte Startuper pour lancer votre campagne.</p>
        </div>
        
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="/js_project/public/auth/registerStartuper" id="registerForm">
            <h5 class="fw-semibold mb-4 pb-2 border-bottom border-custom">Informations Personnelles</h5>
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Nom</label>
                    <input type="text" name="nom" class="form-control bg-surface" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Prénom</label>
                    <input type="text" name="prenom" class="form-control bg-surface" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">CIN (8 chiffres)</label>
                    <input type="text" name="cin" class="form-control bg-surface" pattern="\d{8}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control bg-surface" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control bg-surface" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Mot de passe</label>
                    <input type="password" name="password" class="form-control bg-surface" minlength="6" required>
                </div>
            </div>

            <h5 class="fw-semibold mb-4 pb-2 border-bottom border-custom mt-5">Informations Entreprise</h5>
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Nom de l'entreprise</label>
                    <input type="text" name="nom_entreprise" class="form-control bg-surface" required>
                </div>
                <div class="col-12">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Adresse de l'entreprise</label>
                    <textarea name="adresse_entreprise" class="form-control bg-surface" rows="2" required></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label text-muted-custom small text-uppercase fw-semibold">Registre de commerce</label>
                    <input type="text" name="registre_commerce" class="form-control bg-surface" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Créer mon compte Startuper</button>
        </form>
    </div>
</main>
<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
