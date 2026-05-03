<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="card shadow-sm glass-panel w-100" style="max-width: 400px;">
        <div class="card-body p-4">
            <h2 class="text-center mb-4 text-primary">Connexion</h2>
            
            <?php if(!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="/js_project/public/auth/login">
                <div class="mb-3">
                    <label class="form-label">Pseudo ou Email</label>
                    <input type="text" name="pseudo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3 py-2 hover-elevate">Se connecter</button>
            </form>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
