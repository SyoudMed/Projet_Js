<?php require_once __DIR__ . '/layouts/header.php'; ?>
<?php require_once __DIR__ . '/layouts/navbar.php'; ?>

<main class="flex-grow-1">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container px-4">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4 fw-medium border border-primary border-opacity-25">
                        La plateforme de financement nouvelle génération
                    </span>
                    <h1 class="hero-title">Connecter l'ambition au capital.</h1>
                    <p class="hero-subtitle">StartuPInvest offre aux fondateurs une plateforme simple pour lever des fonds, et aux investisseurs un accès exclusif aux startups les plus prometteuses.</p>
                    
                    <div class="d-flex justify-content-center gap-3 flex-wrap mt-5">
                        <a href="<?= URLROOT ?>/auth/registerInvestor" class="btn btn-primary btn-lg px-5 py-3 shadow-sm">
                            Explorer les opportunités
                        </a>
                        <a href="<?= URLROOT ?>/auth/registerStartuper" class="btn bg-surface border-custom text-main btn-lg px-5 py-3 hover-elevate">
                            Lancer une campagne
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="py-5 bg-surface border-top border-bottom border-custom">
        <div class="container py-5">
            <h3 class="text-center mb-5 pb-3 fw-bold">Comment ça marche ?</h3>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="saas-card h-100 p-5 border-0">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-rocket fs-3"></i>
                        </div>
                        <h4 class="fw-bold mb-3">1. Soumettez</h4>
                        <p class="text-muted-custom mb-0">Créez votre profil startup, déposez votre business plan et définissez votre objectif de financement.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="saas-card h-100 p-5 border-0">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-users fs-3"></i>
                        </div>
                        <h4 class="fw-bold mb-3">2. Connectez</h4>
                        <p class="text-muted-custom mb-0">Les investisseurs explorent votre projet, consultent vos données et investissent en toute sécurité.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="saas-card h-100 p-5 border-0">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-chart-line fs-3"></i>
                        </div>
                        <h4 class="fw-bold mb-3">3. Accélérez</h4>
                        <p class="text-muted-custom mb-0">Atteignez votre objectif de financement et passez à la vitesse supérieure avec vos nouveaux partenaires.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
