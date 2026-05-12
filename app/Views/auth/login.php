<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="saas-card w-100 p-5" style="max-width: 450px;">
        <h2 class="text-center mb-4 fw-bold">Connexion</h2>
        
        <?php if(!empty($error)): ?>
            <div class="alert alert-danger rounded-3"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= URLROOT ?>/auth/login" class="mt-4">
            <div class="mb-4">
                <label class="form-label text-muted-custom small text-uppercase fw-semibold tracking-wider">Pseudo ou Email</label>
                <input type="text" name="pseudo" class="form-control form-control-lg bg-surface" placeholder="Votre identifiant" required>
            </div>
            <div class="mb-4">
                <label class="form-label text-muted-custom small text-uppercase fw-semibold tracking-wider">Mot de passe</label>
                <input type="password" name="password" class="form-control form-control-lg bg-surface" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">Se connecter</button>
            <div class="text-center mt-4">
                <p class="text-muted-custom">Pas encore de compte ? <a href="<?= URLROOT ?>/auth/registerInvestor" class="text-primary text-decoration-none fw-semibold">S'inscrire</a></p>
            </div>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
