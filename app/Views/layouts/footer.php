    <footer class="mt-auto py-5 bg-surface border-top border-custom">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="fw-bold text-main fs-4 mb-3">
                        <i class="fa-solid fa-bolt text-primary me-2"></i>StartuPInvest
                    </div>
                    <p class="text-muted-custom small mb-4" style="max-width: 300px;">
                        La plateforme leader en Tunisie pour connecter les startups innovantes aux investisseurs visionnaires.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-sm btn-light border-custom rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="btn btn-sm btn-light border-custom rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-light border-custom rounded-circle" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-2 ms-lg-auto">
                    <h6 class="fw-bold text-main mb-4">Plateforme</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="<?= URLROOT ?>/investor/catalog" class="text-muted-custom text-decoration-none hover-primary">Parcourir</a></li>
                        <li class="mb-2"><a href="<?= URLROOT ?>/startuper/create" class="text-muted-custom text-decoration-none hover-primary">Lever des fonds</a></li>
                        <li class="mb-2"><a href="#" class="text-muted-custom text-decoration-none hover-primary">Actualités</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-lg-2">
                    <h6 class="fw-bold text-main mb-4">Support</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-muted-custom text-decoration-none hover-primary">FAQ</a></li>
                        <li class="mb-2"><a href="<?= URLROOT ?>/messages/chat?project_id=null&other_id=1" class="text-muted-custom text-decoration-none hover-primary">Aide en ligne</a></li>
                        <li class="mb-2"><a href="#" class="text-muted-custom text-decoration-none hover-primary">Contact</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-lg-2">
                    <h6 class="fw-bold text-main mb-4">Légal</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#" class="text-muted-custom text-decoration-none hover-primary">Confidentialité</a></li>
                        <li class="mb-2"><a href="#" class="text-muted-custom text-decoration-none hover-primary">Conditions</a></li>
                        <li class="mb-2"><a href="#" class="text-muted-custom text-decoration-none hover-primary">Cookies</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-5 border-top border-custom d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="text-muted-custom small mb-3 mb-md-0">
                    &copy; <?= date('Y') ?> StartuPInvest. Fait avec <i class="fa-solid fa-heart text-danger"></i> pour l'écosystème startup.
                </div>
                <div class="d-flex gap-4 small">
                    <span class="text-muted-custom"><i class="fa-solid fa-earth-africa me-2"></i>Français</span>
                    <span class="text-muted-custom"><i class="fa-solid fa-lock me-2"></i>Données Sécurisées</span>
                </div>
            </div>
        </div>
    </footer>
    
    <style>
        .hover-primary:hover { color: var(--primary) !important; transition: color 0.2s ease; }
    </style>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Theme Toggle JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const htmlTag = document.documentElement;
            
            const savedTheme = localStorage.getItem('theme') || 'light';
            htmlTag.setAttribute('data-theme', savedTheme);
            updateIcon(savedTheme);

            if(themeToggleBtn) {
                themeToggleBtn.addEventListener('click', () => {
                    const currentTheme = htmlTag.getAttribute('data-theme');
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    htmlTag.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateIcon(newTheme);
                });
            }

            function updateIcon(theme) {
                if(!themeToggleBtn) return;
                const icon = themeToggleBtn.querySelector('i');
                if (theme === 'dark') {
                    icon.className = 'fa-solid fa-sun text-warning';
                } else {
                    icon.className = 'fa-solid fa-moon';
                }
            }
        });
    </script>
</body>
</html>
