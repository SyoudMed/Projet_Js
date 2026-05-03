<?php require_once __DIR__ . '/../layouts/header.php'; ?>
<?php require_once __DIR__ . '/../layouts/navbar.php'; ?>

<main class="container mt-5 mb-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="card shadow-sm glass-panel w-100" style="max-width: 600px;">
        <div class="card-body p-4">
            <h2 class="text-center mb-4 text-primary">Inscription Startuper</h2>
            
            <?php if(!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="/js_project/public/auth/registerStartuper" id="registerForm">
                <h5 class="text-muted-custom mb-3">Informations Personnelles</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CIN (8 chiffres)</label>
                        <input type="text" name="cin" class="form-control" pattern="\d{8}" title="Le CIN doit comporter exactement 8 chiffres." required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pseudo</label>
                        <input type="text" name="pseudo" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" minlength="6" required>
                    </div>
                </div>

                <hr class="my-4 border-secondary">
                <h5 class="text-muted-custom mb-3">Informations Entreprise</h5>
                <div class="mb-3">
                    <label class="form-label">Nom de l'entreprise</label>
                    <input type="text" name="nom_entreprise" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Adresse de l'entreprise</label>
                    <textarea name="adresse_entreprise" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Numéro de registre de commerce</label>
                    <input type="text" name="registre_commerce" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4 py-2 hover-elevate">Créer mon compte Startuper</button>
            </form>
        </div>
    </div>
</main>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const cin = document.querySelector('input[name="cin"]').value;
    if(!/^\d{8}$/.test(cin)) {
        e.preventDefault();
        alert('Le CIN doit comporter exactement 8 chiffres.');
    }
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
