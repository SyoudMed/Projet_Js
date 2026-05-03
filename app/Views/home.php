<?php require_once __DIR__ . '/layouts/header.php'; ?>
<?php require_once __DIR__ . '/layouts/navbar.php'; ?>

<main class="container mt-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="p-5 mb-4 rounded-3 text-center hero-section w-100 shadow-sm glass-panel">
        <div class="container-fluid py-5">
            <h1 class="display-4 fw-bold text-gradient mb-4">StartuPInvest</h1>
            <p class="col-md-8 mx-auto fs-5 mb-5 text-muted-custom">
                Plateforme de mise en relation Startups & Investisseurs.<br>
                Un projet qui connecte l'ambition entrepreneuriale au capital qui la fait grandir.
            </p>
            <div class="d-flex justify-content-center gap-4 flex-wrap mt-4">
                <a href="/js_project/public/auth/registerStartuper" class="btn btn-primary btn-lg px-5 py-3 pulse-animation rounded-pill shadow">
                    Je suis Startuper
                </a>
                <a href="/js_project/public/auth/registerInvestor" class="btn btn-outline-primary btn-lg px-5 py-3 hover-elevate rounded-pill shadow-sm">
                    Je suis Investisseur
                </a>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
