<?php require_once __DIR__ . '/layouts/header.php'; ?>
<?php require_once __DIR__ . '/layouts/navbar.php'; ?>

<main class="flex-grow-1">
    <!-- Hero Section -->
    <section class="hero-section overflow-hidden">
        <!-- Abstract Background Glows -->
        <div class="position-absolute top-0 start-50 translate-middle-x w-100 h-100" style="z-index: -1; opacity: 0.4;">
            <div class="position-absolute top-0 start-0 translate-middle bg-primary rounded-circle blur-3xl" style="width: 400px; height: 400px; filter: blur(120px); opacity: 0.3;"></div>
            <div class="position-absolute bottom-0 end-0 translate-middle bg-info rounded-circle blur-3xl" style="width: 400px; height: 400px; filter: blur(120px); opacity: 0.3;"></div>
        </div>

        <div class="container px-4">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-4 fw-bold border border-primary border-opacity-25" style="letter-spacing: 0.05em; font-size: 0.75rem;">
                        <i class="fa-solid fa-bolt me-2"></i>LA PLATEFORME DE FINANCEMENT NOUVELLE GÉNÉRATION
                    </span>
                    <h1 class="hero-title display-2">Connecter l'ambition <br><span class="text-primary">au capital.</span></h1>
                    <p class="hero-subtitle fs-5 mx-auto opacity-75">StartuPInvest offre aux fondateurs une plateforme simple pour lever des fonds, et aux investisseurs un accès exclusif aux startups les plus prometteuses.</p>
                    
                    <div class="d-flex justify-content-center gap-3 flex-wrap mt-5">
                        <a href="<?= URLROOT ?>/auth/registerInvestor" class="btn btn-primary btn-lg px-5 py-3 shadow-lg">
                            <i class="fa-solid fa-compass me-2"></i>Explorer les opportunités
                        </a>
                        <a href="<?= URLROOT ?>/auth/registerStartuper" class="btn bg-surface border-custom text-main btn-lg px-5 py-3 hover-elevate shadow-sm">
                            <i class="fa-solid fa-rocket me-2"></i>Lancer une campagne
                        </a>
                    </div>

                    <!-- Trust Bar -->
                    <div class="mt-5 pt-5 opacity-50">
                        <p class="small text-uppercase fw-bold mb-4" style="letter-spacing: 0.1em;">Propulsé par la confiance de +500 startups</p>
                        <div class="d-flex justify-content-center gap-5 grayscale opacity-50">
                            <i class="fa-brands fa-stripe fa-3x"></i>
                            <i class="fa-brands fa-paypal fa-3x"></i>
                            <i class="fa-brands fa-google-pay fa-3x"></i>
                            <i class="fa-brands fa-apple-pay fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="py-5 position-relative">
        <div class="container py-5">
            <div class="text-center mb-5 pb-3">
                <h2 class="fw-bold h1">Comment ça marche ?</h2>
                <p class="text-muted-custom">Une expérience simplifiée pour les deux côtés de l'investissement.</p>
            </div>
            
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="saas-card h-100 p-5 border-0 bg-surface">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="width: 72px; height: 72px;">
                            <i class="fa-solid fa-pencil-square fs-3"></i>
                        </div>
                        <h4 class="fw-bold mb-3">1. Soumettez</h4>
                        <p class="text-muted-custom mb-0">Créez votre profil startup, déposez votre business plan et définissez votre objectif de financement.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="saas-card h-100 p-5 border-0 bg-surface">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="width: 72px; height: 72px;">
                            <i class="fa-solid fa-handshake fs-3"></i>
                        </div>
                        <h4 class="fw-bold mb-3">2. Connectez</h4>
                        <p class="text-muted-custom mb-0">Les investisseurs explorent votre projet, consultent vos données et investissent en toute sécurité.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="saas-card h-100 p-5 border-0 bg-surface">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-4 d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="width: 72px; height: 72px;">
                            <i class="fa-solid fa-chart-line fs-3"></i>
                        </div>
                        <h4 class="fw-bold mb-3">3. Accélérez</h4>
                        <p class="text-muted-custom mb-0">Atteignez votre objectif de financement et passez à la vitesse supérieure avec vos nouveaux partenaires.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats CTA -->
    <section class="py-5 mb-5">
        <div class="container">
            <div class="bg-primary bg-opacity-10 rounded-5 p-5 text-center border border-primary border-opacity-10">
                <div class="row align-items-center">
                    <div class="col-lg-8 text-lg-start">
                        <h2 class="fw-bold mb-2">Prêt à façonner le futur ?</h2>
                        <p class="text-muted-custom mb-0 fs-5">Rejoignez des milliers d'investisseurs et de fondateurs qui changent le monde aujourd'hui.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a href="<?= URLROOT ?>/auth/registerInvestor" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">Démarrer maintenant</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .blur-3xl { filter: blur(100px); }
    .grayscale { filter: grayscale(1); transition: filter 0.3s ease; }
    .grayscale:hover { filter: grayscale(0); }
</style>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
